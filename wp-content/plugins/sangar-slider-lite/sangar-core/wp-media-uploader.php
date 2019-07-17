<?php
/**
 * WordPress Media Uploader
 * @author Haris
 *
 * Use variable name to set on load value, for example:
 *
 * // Image:
 * $('[wp-media] [media-upload-image]').attr('src',response.image);
 * $('[wp-media] [media-remove-button]').attr('data-image-default',response.default_image);
 *
 * // Video:
 * var html5video;
 * html5video = '<video controls width="450px" >';
 * html5video+= '<source src="'+ response.video +'" type="video/mp4">';
 * html5video+= 'Your browser does not support HTML5 video.';
 * html5video+= '</video>';
 *
 * $('[wp-media] [media-upload-video]').html(html5video);
 * $('[wp-media] [media-remove-button]').attr('data-image-default',response.default_image);
 *
 * You can also add the image size selector by create a container with id = "[name]-size"
 */

Class wpMediaUploader
{
	public function __construct($name='wp-media',$type='image',$frame='select',$multiple='false',$preview='true')
	{
		$this->name = $name;
		$this->type = $type;
		$this->frame = $frame;
		$this->multiple = $multiple;
		$this->preview = $preview;

		// print
		$this->print_html();
		$this->print_js();
	}

	private function print_html()
	{
		$return = "<div {$this->name}>";

		if($this->preview == 'true')
		{
			switch ($this->type) {
				case 'image':
					$return.= '<img media-upload-image style="max-width:450px;max-height:250px;" src="" class="media-upload-image">';
					break;

				case 'video':
					$return.= '<div media-upload-video></div>';
					break;
				
				default:
					# code...
					break;
			}
		}
		else
		{
			$return.= '<div media-upload-title><b>No File Selected</b></div>';
		}

		$return.= "<input media-upload-id type='hidden' style='display:none;' name='{$this->name}' value=''>";
		$return.= "<input media-upload-image-url type='hidden' style='display:none;' value=''>";
		$return.= "<div style='margin-top:10px;'>";
		$return.= "<input type='button' class='button-primary button' media-upload-button value='Set {$this->type}'>";
		$return.= "<a class='button' media-remove-button data-image-default  style='margin-left:7px;' >Remove {$this->type}</a>";
		$return.= "</div></div>";

		echo $return;
	}

	private function print_js()
	{
		$append_media = '';
		$remove_action = '';

		if($this->preview == 'true')
		{
			switch ($this->type) {
				case 'image':
					$append_media = "var url = typeof(attachment.sizes.medium) == 'undefined' ? attachment.sizes.full.url : attachment.sizes.medium.url;";
					$append_media.= "$('[{$this->name}]').find('[media-upload-image]').attr('src',url);";
					$append_media.= "$('[{$this->name}]').find('[media-upload-image-url]').val(attachment.url);";

					$remove_action = "$('[{$this->name}]').find('[media-upload-image]').attr('src',$(this).data('image-default'));";
					break;

				case 'video':
					$html5video = '<video controls width="450px" >';
					$html5video.= '<source src="\'+ attachment.url +\'" type="video/mp4">';
					$html5video.= 'Your browser does not support HTML5 video.';
					$html5video.= '</video>';

					$append_media = "$('[{$this->name}]').find('[media-upload-video]').html('$html5video');";
					$remove_action = "$('[{$this->name}]').find('[media-upload-video]').html('<img style=\"width:450px;\" src='+ $(this).data('image-default') +' >');";
					break;
				
				default:
					# code...
					break;
			}
		}
		else
		{
			$append_media = "$('[{$this->name}]').find('[media-upload-title]').html('<b>File Selected: </b>' + attachment.url);";
			$remove_action = "$('[{$this->name}]').find('[media-upload-title]').html('<b>No File Selected</b>');";
		}

		// prevent the same name of media modal to double identified
		$varname = $this->name;
		$varname = str_replace('-', '_', $varname);
		$varname = str_replace(' ', '_', $varname);

		$return = "<script type='text/javascript'>";
		$return.= "	if(typeof(sslider_media_$varname) === 'undefined') var sslider_media_$varname = false;
					if(! sslider_media_$varname) { sslider_media_$varname = true; ";
		$return.= "jQuery(document).ready(function($) {";

		$return.= "$('[{$this->name}]').on('click','[media-upload-button]',function(e) {
	        var custom_uploader
	        var media_button = $(this);

	        e.preventDefault();

	        //If the uploader object has already been created, reopen the dialog
	        if (custom_uploader) {
	            custom_uploader.open();
	            return;
	        }

	        //Extend the wp.media object
	        custom_uploader = wp.media.frames.file_frame = wp.media({
	            frame: '{$this->frame}',
	            title: 'Choose {$this->type}',
	            library : { type : '{$this->type}'},
	            button: {
	                text: 'Choose {$this->type}'
	            },
	            multiple: {$this->multiple}
	        });
	 
	        //When a file is selected, grab the URL and set it as the text field's value
	        custom_uploader.on('select', function() {
	            var attachment = custom_uploader.state().get('selection').first().toJSON();

	            $('[{$this->name}]').find('[media-upload-id]').val(attachment.id);
	            $append_media
	            
				// dropdown image size
	            if($('#$this->name' + '-size').length > 0)
	            {
	            	var select = '<select>';
	            	
	            	$.each(attachment.sizes,function(index,value){
	            		var name = index.charAt(0).toUpperCase() + index.slice(1);
	            		var size = value.width + ' &times; ' + value.height;
	            		var attr = 'url=\"' + value.url + '\" width=\"' + value.width + '\" height=\"' + value.height + '\"';
	            		var selected = '';

	            		if(index == 'medium' || index == 'full' && parseInt(value.width) <= 300)
	            		{
	            			selected = 'selected';
	            		}
	            		else selected = '';

	            		select += '<option ' + selected + ' ' + attr +  ' value=\"' + index + '\" >' + name + ' &ndash; ' + size + '</option>';
	            	});

					select += '</select>';

					// show the image size selection
					$('#$this->name' + '-size').html(select);
	            }
	        });
	 
	        //Open the uploader dialog
	        custom_uploader.open();
	 
	    }).on('click','[media-remove-button]',function(){

	        $('[{$this->name}]').find('[media-upload-id]').val('');
	        $('[{$this->name}]').find('[media-upload-image-url]').val('');
	        $remove_action

	        // dropdown image size
	        if($('#$this->name' + '-size').length > 0)
	        {
	        	$('#$this->name' + '-size').html('<i>Please select an image first</i>');
	        }
	    });";

		$return.= "});";
		$return.= "} //if sslider_media_$varname";
		$return.= "</script>";

		echo $return;
	}
}