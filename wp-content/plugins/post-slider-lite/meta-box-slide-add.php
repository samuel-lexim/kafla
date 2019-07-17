<?php

/** 
 * Prints the box content 
 */
function sslider_slide_add_callback( $post ) 
{
	?>

    <div class="updated sangar-slider-notice"><p>The changes has been made, please <b>Save or Update</b> Your Slideshow.</p></div>
    
    <a href="javascript:;" sslider-config-post-slider data-slug='post-slider' class="button button-primary sslider-edit-template">Edit Template</a>
    <a href="javascript:;" sslider-custom-css class="button">Custom CSS</a>
    <a href="javascript:;" sslider-advanced-config class="button button-primary">Upgrade to Pro</a>

    <!-- Ajax Progress Loader -->
	<div id="sangar_ajax_on_progress">On Progress..</div>
	
    <?php
}