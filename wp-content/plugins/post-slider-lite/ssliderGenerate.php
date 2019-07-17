<?php
/**
 * Class ssliderGenerate
 * @author Haris
 */

Class ssliderGenerateAddonPost extends ssliderGenerate
{
	public $status;

	function __construct($id,$data,$config,$args,$post_type)
	{
	    $this->id = $id;
	    $this->post_type = $post_type;
	    $this->args = $args;
	    $this->preview = $args['preview'];
	    $this->data = $data;
	    $this->config = $config;
	    $this->status = is_array($data) && count($data) > 0 ? true : false;
	    $this->base_url = SANGAR_CORE_DIR_URL;
	    $this->slider_id = "sangar-slider-{$this->id}";
	    $this->fonts = Array();

	    if($this->status) {
	    	$this->wp_enqueue_core();
	    }
	    else
	    {
	    	echo "<code>";
	    	echo "Sangar Slider :: No slide found!, please make sure you have at least one slide.";
	    	echo "</code>";
	    }
	}

	function html()
	{
		if(! $this->status)	return false;

		$added_class = $this->config['mobileFullContentBox'] == 'true' ? 'mobile-full-content-box' : '';

		$width = $this->config['fullWidth'] == 'true' ? '100%' : $this->config['width'].'px';
        $height = $this->config['height'].'px';

		$init_style = "width: $width;";
        $init_style.= "height: $height;";
        $init_style.= "max-width: 100%;";
        $init_style.= "position: relative;";
        $init_style.= "margin-left: auto;";
        $init_style.= "margin-right: auto;";
        $init_style.= "display: block;";

		$html = "<div class='{$this->slider_id} $added_class' sslider-id='{$this->slider_id}' style='$init_style'>";

		$layer_fonts = array();
		$page_counter = 0;

		// variable to javascript
		$put_to_javascript = "if(typeof(sslider_layer_data) === 'undefined') var sslider_layer_data = {};";
		$put_to_javascript.= 'sslider_layer_data["' . $this->slider_id . '"] = [];';
		$iterate_num = 0;

		$this->ecae_filter('remove'); // remove ecae filter

		foreach ($this->data as $key => $value) 
		{
			$value = ssliderDefault::slide($value,$this->post_type);
			$wp_query_builder = $this->wp_query_builder($value);
			$the_query = new WP_Query($wp_query_builder);
			$total_number = $the_query->found_posts;

			while ($the_query->have_posts())
			{
				$the_query->the_post();
				$the_ID = get_the_ID();

				$html.= "<div class='sangar-content' style='display:none;'>";
				$html.= $this->slide_overlay($value);

				// slide permalink current post
				if($value['tab-bg-permalink-current-post'] != 'false') 
				{
					$target = $value['tab-bg-permalink-current-post'];

					$html.= "<a target='$target' href='" . get_the_permalink() . "'></a>";
				}

				// background
				if(! has_post_format() && has_post_thumbnail())
			    {
			        // size: thumbnail, medium, large or full
			        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($the_ID), $value['tab-bg-featured-size']);
			        $url = $thumb[0];
			        $width = $thumb[1];
			        				        
			        $html.= "<img alt='" . get_the_title() . "' src='" . $url . "'>";
			    }
			    else
			    {
			    	$html.= $this->slide_background($value);
			    }

			    // layer
			    $anim_enable = $value['tab-content-anim-all'];
				$anim_type = $value['tab-content-anim-type'];
				$anim_duration = $value['tab-content-anim-duration'];
				$anim_stagger = $value['tab-content-anim-stagger'];
				$animation = "data-anim-enable='$anim_enable' data-anim-type='$anim_type' data-anim-duration='$anim_duration' data-anim-stagger='$anim_stagger'";

				// apply sangar post shortcode
				$page_counter++;
				$layer_data = $this->apply_shortcode($value['slide-layer'],$page_counter);
				
				// convert text to php to apply any wp shortodes
				$php_content = json_decode($layer_data);

				// shortcode-able desktop content
				if(isset($php_content->desktop->content) && is_array($php_content->desktop->content)) {
					$content_desktop = $php_content->desktop->content;
					
					for ($i=0; $i < count($content_desktop); $i++) {
						if($content_desktop[$i]->contentType == 'text') {
							$output_html = $php_content->desktop->content[$i]->html;

							if($output_html != '') {
								$php_content->desktop->content[$i]->html = do_shortcode($output_html);
							}							
						}
					}
				}

				// shortcode-able mobile content
				if(isset($php_content->mobile->content) && is_array($php_content->mobile->content)) {
					$content_mobile = $php_content->mobile->content;

					for ($i=0; $i < count($content_mobile); $i++) {
						if($content_mobile[$i]->contentType == 'text') {
							$output_html = $php_content->mobile->content[$i]->html;

							if($output_html != '') {
								$php_content->mobile->content[$i]->html = do_shortcode($output_html);
							}							
						}
					}
				}

				// convert again to string then encript
				$php_content = json_encode($php_content);
				$layer_data = base64_encode($php_content);

				// put layer data to js
				$put_to_javascript.= 'sslider_layer_data["' . $this->slider_id . '"][' . $iterate_num . '] = "' . $layer_data . '";';
				$iterate_num++;	

				$html_data = "data-treshold={$this->config['mobileTreshold']} data-type='unset' data-is-mobile='{$value['slide-layer-is-mobile']}'";
				$is_mobile = $value['slide-layer-is-mobile'] == 'false' ? 'layer-desktop-mode' : '';
				$html.= "<div $animation class='sangar-html-content sangar-layer $is_mobile' $html_data ></div>";
		
				// get all loaded font
				preg_match_all('/font_type":"(.*?)","font_weight/s', $value['slide-layer'], $text_font);
				preg_match_all('/text_font":"(.*?)","text_weight/s', $value['slide-layer'], $button_font);
				$layer_fonts = array_merge($layer_fonts,$text_font[1],$button_font[1]);

			    $html.= "</div>";
			}

			wp_reset_query();
		}

		$this->ecae_filter('add'); // re-add ecae filter

		$layer_fonts = array_unique($layer_fonts);
		$this->fonts = array_merge($this->fonts,$layer_fonts);

		// add inline script
		wp_add_inline_script('sslider-js', $put_to_javascript);

		// add loading
		$loading_attr = 'style="display:block;position:absolute;width:100%;height:100%;z-index:99;top:0px;left:0px;"';
		$html.= '<div class="sangar-slider-loading" '. $loading_attr .' ><div><span id="span_1"></span><span id="span_2"></span><span id="span_3"></span></div></div>';

		$html.= "</div>";

		return $html;
	}

	private function apply_shortcode($layer_data,$page_counter)
	{
		global $post;

		$excerpt = $post->post_excerpt != '' ? $post->post_excerpt : $this->excerpt(get_the_content());

		$layer_data = str_replace('[sslider-post-title]', addslashes(get_the_title()), $layer_data);
		$layer_data = str_replace('[sslider-post-content-excerpt]', addslashes($excerpt), $layer_data);
		$layer_data = str_replace('[sslider-post-author]', addslashes(get_the_author()), $layer_data);
		$layer_data = str_replace('[sslider-post-date-created]', addslashes(get_the_date()), $layer_data);
		$layer_data = str_replace('[sslider-post-category]', addslashes($this->get_all_terms()), $layer_data);		
		$layer_data = str_replace('[sslider-post-permalink]', addslashes(get_post_permalink()), $layer_data);		
		$layer_data = str_replace('[sslider-post-page-number]', addslashes($page_counter), $layer_data);		

		// post featured image
		$layer_data = preg_replace_callback("/\[sslider-featured-image\s*=\s*\\\?[\"|'](.+?)\\\?[\"|']\s*\]/", 
			function ($matches)
			{
				$size = $matches[1]; // thumbnail, medium, large or full
		        $attachment = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),$size);
		        $src = $attachment[0];
		        $image = "<img src='$src'>";

				return $image;
			}, $layer_data);

		// sslider-post-content-excerpt
		$layer_data = preg_replace_callback("/\[sslider-post-content-excerpt\s*=\s*\\\?[\"|'](.+?)\\\?[\"|']\s*\]/", 
			array($this, 'apply_shortcode_excerpt'),
			$layer_data
		);

		// sslider-post-meta
		$layer_data = preg_replace_callback("/\[sslider-post-meta\s*=\s*\\\?[\"|'](.+?)\\\?[\"|']\s*\]/", 
			function ($matches) {
				return addslashes(get_post_meta(get_the_ID(),$matches[1],true));
			}, $layer_data);

		return $layer_data;
	}

	private function apply_shortcode_excerpt($matches) {
		$fixed = (int)preg_replace("/[^\d]+/","",$matches[1]);
		$content_excerpt = $this->excerpt(get_the_content(),$fixed);

		return addslashes($content_excerpt);
	}

	private function excerpt($text,$fixed = 150)
	{
		$text = strip_shortcodes($text); // remove shortcodes
		$text = apply_filters('the_content', $text); // apply the content filter
		$text = wp_filter_nohtml_kses($text); // remove html tags
		$text = trim(preg_replace('/\s+/', ' ', $text)); // remove new line
	    $excerpt = '';	    
		
		if(strlen($text) >= $fixed)
		{
			$pos = strpos($text, ' ', $fixed);
			$excerpt = substr($text,0,$pos);
			// delete last non alphanumeric character (save ">" if you want to save html tag)
			$excerpt = preg_replace('/[`!@#$%^&*()_+=\-\[\]\';,.\/{}|":<>?~\\\\]$/', '', $excerpt);
		}

		$excerpt = $excerpt == '' ? $text : $excerpt;

		return $excerpt;
	}

	// handle 'the_content' filter from ECAE plugin if exist
	private function ecae_filter($action)
	{
		if(! function_exists('tonjoo_ecae_execute')) return;

		// action
		if($action == 'remove') {
			remove_filter('the_content', 'tonjoo_ecae_execute', 10);
		} 
		else if($action == 'add') {
			add_filter('the_content', 'tonjoo_ecae_execute', 10);
		}
	}

	private function wp_query_builder($value)
	{
		$post_type = 'post';
		$order_by = $value['sangar_query_order_by'];
		$order = $value['sangar_query_order'];
		$limit = $value['sangar_query_limit'];
		$terms = $value['sangar_query_terms'];
		$tax_array = array();
		$wpe_query = array();

		// phase 1
		if(is_array($terms) && count($terms) > 0) {
			foreach ($terms as $key => $term) 
			{
				// for an old value that still use array
				if(is_array($term)) {
					$term = $term[0];
				}

				$exp = explode('::', $term);

				if(count($exp) >= 2) $tax_array[$exp[0]][] = $exp[1];
			}
		}

		// phase 2
		$wpe_query['post_type'] = $post_type;
		$wpe_query['post_status'] = 'publish';
		$wpe_query['orderby'] = is_array($order_by) ? $order_by[0] : $order_by;
		$wpe_query['order'] = is_array($order) ? $order[0] : $order;
		$wpe_query['posts_per_page'] = is_array($limit) ? $limit[0] : $limit;
		
		if(count($tax_array) > 0)
		{
			$wpe_query['tax_query'] = array();				
			$wpe_query['tax_query']['relation'] = 'OR';

			foreach ($tax_array as $key => $value) 
			{
				$wpe_query['tax_query'][] = array(
					'taxonomy' => $key,
					'field' => 'id',
					'terms' => $value
				);
			}
		}

		return $wpe_query;
	}

	private function get_all_terms()
	{
		global $post;

		$post = get_post( $post->ID );
		$post_type = $post->post_type;
		$taxonomies = get_object_taxonomies($post_type,'objects');

		$out = array();
		foreach ($taxonomies as $taxonomy_slug => $taxonomy)
		{
			// get the terms related to post
			$terms = get_the_terms( $post->ID, $taxonomy_slug );

			if ( !empty( $terms ) ) 
			{
				foreach ( $terms as $term ) {
			  		$out[] = $term->name;
			  	}
			}
		}

		// limit 4 items
		$out = array_slice($out, 0, 4);

		return implode(', ', $out);
	}

	function javascript()
	{
		if(! $this->status)	return false;

		$http_proto = is_ssl() ? 'https://' : 'http://';		
		$config = $this->override_config($this->config);

		$no_string_key = array(
			'paginationContent',
			'paginationImageAttr',
			'onInit',
			'onReset',
			'beforeLoading',
			'afterLoading',
			'beforeChange',
			'afterChange',
			'afterImagesLoaded',
		);

		$no_string_value = array('true','false');
				
		$javascript = "jQuery(document).ready(function($) { \r\n";
		$javascript.= "var http_proto = '".$http_proto."'; \r\n";
		$javascript.= "$('.{$this->slider_id}').sangarSlider({ \r\n";

		// print config to javascript
		foreach($config as $key => $value)
		{
			if(is_numeric($value) || in_array($key, $no_string_key) || in_array($value, $no_string_value))
			{
				$javascript.= "$key : $value, \r\n";
			}
			else
			{
				$javascript.= "$key : '$value', \r\n";
			}
		}

		// Youtube modal
		$youtube_modal_js = "base.".'$el'.".find('.sangar-slider-video-modal').on('click',function(){
							
			var fullscreen = [($(window).width() - 100),($(window).height() - 100)];

			var video = $(this).data('video');
				video = base.convertEmbedMedia(video,fullscreen,true);

			$.fancybox(video,
			{
				'transitionIn' : 'none',
				'transitionOut' : 'none',
				'autoScale' : true,
				'scrolling' : 'no',
				'onStart' : function(){
					base.timerObj.pauseClock();
				},
				'onClosed' : function(){
					setTimeout(function() {
						base.timerObj.resumeClock();
					}, 200);
				}
			});
		});";

		// Google webfont
		$webfont_string = $this->webfont_string();
		
		if($webfont_string != '')
		{
	        wp_enqueue_script('sslider-webfont-js',"https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js",array(),SANGAR_SLIDER_VERSION);
			
			$javascript.= "autoRun : false, \r\n";
			$javascript.= "afterImagesLoaded : function(base) { \r\n";
			$javascript.= "	WebFontConfig = {
							  	google: {
							    	families: [". $webfont_string ."]
							  	},
							  	active: function() {
							  		base.run();
							  	},
							  	inactive: function() {
							  		base.run();
							  	}
							};\r\n";

			$javascript.= "WebFont.load(WebFontConfig); \r\n";
			$javascript.= "}, \r\n";
		}

		$javascript.= "onResetTimeoutFunction : function(base) { \r\n";
		$javascript.= $youtube_modal_js;
		$javascript.= "} \r\n";

		$javascript.= "});}); \r\n";

		// add inline script
		wp_add_inline_script('sslider-js', $javascript);

		return ''; // return empty string, incase of echoing
	}

	function css()
	{
		if(! $this->status)	return false;

		$custom_css = stripslashes($this->config['custom_css']);

		// added css
		if($this->config['timerColor'] != '')
		{
			$timerColor = $this->config['timerColor'];			
			$custom_css.= "[ss-id] div.sangar-timer div.sangar-timer-mask { background-color:$timerColor; }";
		}

		$custom_css = str_replace('[ss-id]', '.' . $this->slider_id . '.sangar-slideshow-container', $custom_css);
		$custom_css = str_replace('[ss-dir]', SANGAR_SLIDER_DIR_URL . 'elements/', $custom_css);
		
		// add inline style
		wp_add_inline_style('sslider-css', $custom_css);
		
		return ''; // return empty string, incase of echoing
	}

	function slide_content()
	{
		if(! $this->status)	return false;

		$content = array();

		foreach ($this->data as $key => $slide)
		{
			$slide = ssliderDefault::slide($slide,$this->post_type);

			$content_val['title'] = $slide['slide-title'];
			$content_val['button'] = '';

			switch ($slide['tab-content-selection']) {
				case 'text':
					$content_val['description'] = $slide['tab-content-text'];
					break;

				case 'text-and-button':
					$content_val['description'] = $slide['tab-content-text'];
					break;

				case 'html':
					$content_val['description'] = $this->slide_content_html($slide);
					break;
				
				default: // silent
			}
			
			$content[] = $content_val;
		}

		return $content;
	}


	/**
	 * Private Functions
	 */
	private function setImagePaginationSize($config)
	{
		if($config['pagination'] == 'content-horizontal' && $config['paginationContentType'] == 'image')
		{
			$max = 120;
			$min = 60;

			if($config['width'] > $config['height'])
			{
				$oneby =  $config['height'] / $config['width'];
				$min_value = $max * $oneby > $min ? $max * $oneby : $min;

				$config['paginationContentWidth'] = $max;
				$config['paginationImageHeight'] = $min_value;
			}
			else
			{
				$oneby =  $config['width'] / $config['height'];
				$min_value = $max * $oneby > $min ? $max * $oneby : $min;

				$config['paginationImageHeight'] = $max;
				$config['paginationContentWidth'] = $min_value;
			}
		}

		return $config;
	}

	private function webfont_string()
	{
		$this->fonts = array_unique($this->fonts);

		$webfont_string = '';

		foreach ($this->fonts as $key => $value) 
		{
			if($value == '') continue;

			$webfont_string.= "'".tonjooGoogleFonts::$fonts[$value]."',";
		}

		return $webfont_string;
	}

	private function override_config($config)
	{
		// pagination config
		if($config['pagination'] == 'content-horizontal' || $config['pagination'] == 'content-vertical') {
			$config = $this->pagination_content();
		}

		// animateContent
		if(! isset($config['animateContent'])) $config['animateContent'] = 'true';

		// fadeAnimation
		if($config['fadeAnimation'] == 'true') $config['animation'] = 'fade';

		// setImagePaginationSize
		$config = $this->setImagePaginationSize($config);

		// unset
		unset($config['is_preview'],$config['custom_css'],$config['template'],$config['fadeAnimation'],$config['mobileFullContentBox'],$config['timerColor']);

		return $config;
	}

	private function pagination_content()
	{
		$config = $this->config;
		$content = '';
		$image_attr = '';

		foreach ($this->data as $key => $value):
		if($config['paginationContentType'] == 'text')
		{
			$title = htmlspecialchars($value['slide-title']);
			$content.= '"' . $title . '",';					
		}
		else if($config['paginationContentType'] == 'image')
		{
			$background_attr = '';

			switch ($value['tab-bg-selection']) {
				case 'image':
					$attr = array(
						'alt' => $value['slide-title']
					);

					if($value['tab-bg-image'] != '' && $value['tab-bg-image'] > 0)
					{
						$background = wp_get_attachment_image_src($value['tab-bg-image'],'thumbnail',false,$attr);
						$background = $background[0];
					}
					else
					{
						$background = SANGAR_CORE_DIR_URL.'assets/images/thumbnail_slide_image.jpg';
					}
					
					break;

				case 'color':
					$background = SANGAR_CORE_DIR_URL.'assets/images/small_thumb_color.png';
					$background_attr = "style='background-color:{$value['tab-bg-color']}'";
					break;

				case 'video':
					$background = SANGAR_CORE_DIR_URL.'assets/images/thumbnail_slide_video.jpg';
					break;

				case 'iframe':
					$background = SANGAR_CORE_DIR_URL.'assets/images/thumbnail_slide_youtube_vimeo.jpg';
					break;

				case 'html':
					$background = SANGAR_CORE_DIR_URL.'assets/images/thumbnail_slide_html.jpg';
					break;

				default: 
					$background = '';
			}
			
			$content.= '"' . $background . '",';
			$image_attr.= '"' . $background_attr . '",';
		}
		endforeach;

		rtrim($content, ",");
		rtrim($image_attr, ",");
		$content = "[$content]";
		$image_attr = "[$image_attr]";

		$config['paginationContent'] = $content;
		$config['paginationImageAttr'] = $image_attr;

		return $config;
	}

	private function slide_overlay($slide)
	{
		if($slide['tab-bg-selection'] != 'image' && $slide['tab-bg-selection'] != 'video') return '';

		switch ($slide['tab-overlay-selection']) 
		{
			case 'color':
				$style = "background: {$slide['tab-overlay-color']};";
				break;

			case 'select-image':
				$pattern_images = apply_filters('sangar_slider_pattern_images',array());
				$url = $pattern_images[$slide['tab-overlay-select-image']]['url'];

				$style = 'background: url("'.$url.'");';
				break;

			case 'upload-image':
				$url = wp_get_attachment_image_src($slide['tab-overlay-upload-image'],'original');
				$style = 'background: url("'.$url[0].'");';
				break;
			
			default: return '';
		}

		$style.= 'position: absolute;';
		$style.= 'top: 0;right: 0;bottom: 0;left: 0;';
		$style.= 'z-index: 5;';

		$overlay = "<div style='$style' ></div>";

		return $overlay;
	}

	private function slide_background($slide)
	{
		switch ($slide['tab-bg-selection']) {
			case 'image':
				$attr = array(
					'alt' => $slide['slide-title']
				);

				$background = wp_get_attachment_image($slide['tab-bg-image'],'full',false,$attr);
				break;

			case 'color':				
				$css = "background:{$slide['tab-bg-color']};";
				$background = "<div class='sangar-bg-content' style='$css'></div>";
				break;

			case 'video':
				$poster = wp_get_attachment_image_src($slide['tab-bg-video-html5-poster'],'full');
				$src = wp_get_attachment_url($slide['tab-bg-video-html5']);
				$cant_load = "Your browser does not support HTML5 video.";
				$attr = "style='width:100%;' preload='none'";

				$background = "<video class='sangar-slide-video' poster='$poster[0]' $attr><source src='$src'>$cant_load</video>";
				break;

			case 'iframe':
				$background = $this->convert_embed_media($slide['tab-bg-video-iframe']);
				break;

			case 'html':
				$background = "<div class='sangar-bg-content'>{$slide['tab-bg-html']}</div>";
				break;
			
			default:
				$background = '';
		}

		return $background;
	}

	private function slide_hyperlink($slide)
	{
		$trimed = str_replace(' ', '', $slide['slide-hyperlink']);

		if($trimed != '')
		{
			return "<a href='{$slide['slide-hyperlink']}'></a>";
		}
		else return null;
	}

	private function get_content_padding($type,$custom)
	{
		$content_padding = array(
			'small' => '1.5em 1.5em',
			'medium' => '2.5em 2.5em',
			'large' => '3.5em 3.5em',
			'x-large' => '4.2em 4.2em',
			'custom' => $custom
		);

		// return
		if(isset($content_padding[$type]))
		{
			return $content_padding[$type];
		}
		else
		{
			return $content_padding['medium'];
		}			
	}

	private function get_textbox_animation($slide)
	{
		$anim_enable = $slide['tab-content-anim-all'];

		$anim_type = $slide['tab-content-anim-type'];
		$anim_duration = $slide['tab-content-anim-duration'];
		$anim_stagger = $slide['tab-content-anim-stagger'];
		$animation = "data-anim-enable='$anim_enable' data-anim-type='$anim_type' data-anim-duration='$anim_duration' data-anim-stagger='$anim_stagger'";

		return $animation;
	}

	private function slide_content_html($slide)
	{
		// background
		switch ($slide['tab-html-bg-type'])
		{
			case 'transparent':
				$img = $this->base_url."assets/images/transparent/{$slide['tab-html-bg-transparent']}.png";
				$background = "url($img) repeat scroll 0% 0% transparent";
				break;

			case 'color':
				$background = "{$slide['tab-html-bg-color']}";
				break;
			
			default:
				$background = '';
		}

		$html = "<div class='sangar-html-content' style='background:$background;'>{$slide['tab-content-html']}</div>";

		return $html;
	}

	private function convert_embed_media($html)
    {
    	$html = trim($html);
    	$wordCount = substr_count($html, ' ');

    	$error = "<p style='color:#ffffff;'>Cannot parse the embed source!, please check your input.</p>";

    	// if word are > 1 (0 = 1 in this case)

    	if($wordCount > 0) return $error;

    	// else:

    	$origin = $html;
        $pattern1 = "/(?:http?s?:\/\/)?(?:www\.)?(?:vimeo\.com)\/(?:.*\/)?(.+)/";
        $pattern2 = "/(?:http?s?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/";
        
        if(preg_match($pattern1,$html)){
           $replacement = '<iframe src="//player.vimeo.com/video/$1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';	           
           $html = preg_replace($pattern1, $replacement, $html);
        }
        
        if(preg_match($pattern2,$html)){
            $replacement = '<iframe src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>';
            $html = preg_replace($pattern2, $replacement, $html);
        }

        if($html == $origin) $html = $error;
        
        return $html;
	}
}