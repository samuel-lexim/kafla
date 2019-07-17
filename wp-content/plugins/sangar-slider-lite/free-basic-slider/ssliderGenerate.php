<?php
/**
 * Class ssliderGenerate
 * @author Haris
 */

Class ssliderGenerateAddonBasic extends ssliderGenerate
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

	    if($this->status) 
	    {
	    	$this->wp_enqueue_core();
	    	$this->wp_enqueue();	    	
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

		$html = "<div class='{$this->slider_id} $added_class' style='$init_style'>";

		$layer_fonts = array();

		foreach ($this->data as $key => $value) 
		{		
			$value = ssliderDefault::slide($value,$this->post_type);

			$html.= "<div class='sangar-content' style='display:none;'>";
			$html.= $this->slide_overlay($value);
			$html.= $this->slide_background($value);
			$html.= $this->slide_hyperlink($value);

			if($value['slide-type'] == 'static')
			{
				switch ($value['tab-content-selection']) 
				{
					case 'text':
						$html.= $this->slide_content_textbox($value,false);
						break;

					case 'text-and-button':
						$html.= $this->slide_content_textbox($value,true);
						break;

					case 'html':
						$html.= $this->slide_content_html($value);
						break;
					
					default: // silent
				}

				
			}
			else if($value['slide-type'] == 'layer')
			{
				$anim_enable = $value['tab-content-anim-all'];

				$anim_type = $value['tab-content-anim-type'];
				$anim_duration = $value['tab-content-anim-duration'];
				$anim_stagger = $value['tab-content-anim-stagger'];
				$animation = "data-anim-enable='$anim_enable' data-anim-type='$anim_type' data-anim-duration='$anim_duration' data-anim-stagger='$anim_stagger'";

				$layer_data = base64_encode($value['slide-layer']);

				$html_data = "data-treshold={$this->config['mobileTreshold']} data-type='unset' data-is-mobile='{$value['slide-layer-is-mobile']}'";

				$is_mobile = $value['slide-layer-is-mobile'] == 'false' ? 'layer-desktop-mode' : '';

				$html.= "<div $animation class='sangar-html-content sangar-layer $is_mobile' $html_data >$layer_data</div>";
			
				// get all loaded font
				preg_match_all('/font_type":"(.*?)","font_weight/s', $value['slide-layer'], $text_font);
				preg_match_all('/text_font":"(.*?)","text_weight/s', $value['slide-layer'], $button_font);

				$layer_fonts = array_merge($layer_fonts,$text_font[1],$button_font[1]);
			}
			
			$html.= "</div>";
		}

		$layer_fonts = array_unique($layer_fonts);
		$this->fonts = array_merge($this->fonts,$layer_fonts);

		// add loading
		$loading_attr = 'style="display:block;position:absolute;width:100%;height:100%;z-index:99;top:0px;left:0px;"';
		$html.= '<div class="sangar-slider-loading" '. $loading_attr .' ><div><span id="span_1"></span><span id="span_2"></span><span id="span_3"></span></div></div>';

		$html.= "</div>";

		return $html;
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
					$content_val['button'] = $this->slide_content_button($slide);
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

	private function wp_enqueue()
	{
		$version = SANGAR_SLIDER_VERSION;
        $textbox_fonts = array();

		/**
		 * Content textbox
		 */
	    foreach ($this->data as $key => $value) 
		{
			$value = ssliderDefault::slide($value,$this->post_type);

			// continue/skip if html
			if($value['tab-content-selection'] == 'html') continue;

			$title_font = $value['tab-content-title-font'];
			$desc_font = $value['tab-content-description-font'];
			$btn_font = $value['tab-content-btn-font'];
			$btn_skin = $value['tab-content-btn-skin'];

			// title & description
			if($title_font != '') array_push($textbox_fonts, $title_font);
			if($desc_font != '') array_push($textbox_fonts, $desc_font);

			// continue/skip if not use button
			if($value['tab-content-selection'] != 'text-and-button') continue;

			// button font
			if($btn_font != '') array_push($textbox_fonts, $btn_font);
	     	
	     	// button skin
	     	if(file_exists(plugin_dir_path( __DIR__ )."elements/buttons/$btn_skin.css"))
	     	wp_enqueue_style($btn_skin,plugin_dir_url( __DIR__ )."elements/buttons/$btn_skin.css",array(),$version);
		}

		$textbox_fonts = array_unique($textbox_fonts);
		$this->fonts = array_merge($this->fonts,$textbox_fonts);
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

		if($trimed != '') {
			return "<a href='{$slide['slide-hyperlink']}' target='{$slide['slide-hyperlink-target']}'></a>";
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

	private function slide_content_textbox($slide,$button = false)
	{
		if(! empty($this->args['hideTextbox'])) return;
		
		$textbox_class = $button ? 'sangar-textbox-with-button' : '';
		
		// styles
		$textbox_style = $this->get_textbox_style($slide);
		$title_style = $this->get_content_style('title',$slide);
		$description_style = $this->get_content_style('description',$slide);
		$animation = $this->get_textbox_animation($slide);
		
		// whenever has shortcode or not
		$content_maybe_has_shortcode = do_shortcode($slide['tab-content-text']);

		$textbox = "<div class='sangar-textbox $textbox_class' $animation>";
		$textbox.= "<div class='sangar-textbox-inner sangar-position-{$slide['tab-content-position']}'>";			
		$textbox.= "<div class='sangar-textbox-content' style='$textbox_style'>";

		// title
		$textbox.= "<div class='sangar-textbox-title' style='text-align:{$slide['tab-content-title-align']};'>";
		$textbox.= "<p class='sangar-slide-title' style='$title_style'>{$slide['slide-title']}</p>";
		$textbox.= "</div>";
		
		// description
		$textbox.= "<div class='sangar-textbox-description' style='text-align:{$slide['tab-content-description-align']};'>";
		$textbox.= "<div style='$description_style'>$content_maybe_has_shortcode</div>";
		$textbox.= "</div>";

		if($button)
		{
			$textbox.= "<div class='sangar-textbox-button'>";
			$textbox.= $this->slide_content_button($slide);
			$textbox.= "</div>";
		}

		$textbox.= "</div></div></div>";

		return $textbox;
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

	private function get_textbox_style($slide)
	{
		$width = $slide['tab-content-width'] / 12 * 100;
		$width = $width . '%';
		$style = "width:$width;";
		
		// textbox
		switch ($slide['tab-content-bg-type'])
		{
			case 'transparent':
				$img = $this->base_url."assets/images/transparent/{$slide['tab-content-bg-transparent']}.png";
				$style.= "background:url($img) repeat scroll 0% 0% transparent;";
				break;

			case 'color':
				$style.= "background:{$slide['tab-content-bg-color']};";
				break;
			
			default: // silent
		}

		if($slide['tab-content-bg-type'] != 'none')
		{
			$padding = $this->get_content_padding($slide['tab-content-padding-type'],$slide['tab-content-padding']);
			$style.= "padding:$padding;display:block;";
			// $style.= "padding:$padding;display:inline-block;";
		}	

		return $style;
	}

	private function get_content_style($type,$slide)
	{
		$style = "color:{$slide['tab-content-'.$type.'-color']};font-size:{$slide['tab-content-'.$type.'-size']}em;";
		$style.= "font-family:{$slide['tab-content-'.$type.'-font']};";

		switch ($slide['tab-content-'.$type.'-bg-type'])
		{
			case 'transparent':
				$img = $this->base_url."assets/images/transparent/{$slide['tab-content-'.$type.'-bg-transparent']}.png";
				$style.= "background:url($img) repeat scroll 0% 0% transparent;";
				break;

			case 'color':
				$style.= "background:{$slide['tab-content-'.$type.'-bg-color']};";
				break;
			
			default: // silent
		}

		if($slide['tab-content-'.$type.'-bg-type'] != 'none')
		{
			$padding = $this->get_content_padding($slide['tab-content-'.$type.'-bg-padding'],$slide['tab-content-'.$type.'-bg-padding-custom']);
			$style.= "padding:$padding;display:block;";
			// $style.= "padding:$padding;display:inline-block;";
		}

		return $style;
	}

	private function slide_content_button($slide)
	{
		$align = $slide['tab-content-btn-align'];
		$font = $slide['tab-content-btn-font'];
		$size = $slide['tab-content-btn-size'] . 'em';

		$button_style = "text-align:$align;font-family:$font;font-size:$size;";

		$button = "<p class='sslider-button {$slide['tab-content-btn-skin']}' style='$button_style'>";
		$button.= "<a class='sslider-link' href='{$slide['tab-content-btn-link']}' target='{$slide['tab-content-btn-link-target']}'>";
		$button.= "<span>{$slide['tab-content-btn-caption']}</span></a></p>";

		return $button;
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

		// whenever has shortcode or not
		$content_maybe_has_shortcode = do_shortcode($slide['tab-content-html']);

		$html = "<div class='sangar-html-content' style='background:$background;'>$content_maybe_has_shortcode</div>";

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