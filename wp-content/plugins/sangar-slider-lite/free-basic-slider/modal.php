<?php
$form_lib = new tonjooFormLibrary();

// transparent color/images options
$dir = SANGAR_SLIDER_DIR_PATH . 'sangar-core/assets/images/transparent';

$backgrounds        = scandir( $dir );
$transparent_images = array();

foreach ( $backgrounds as $key => $value ) {
	$extension = pathinfo( $value, PATHINFO_EXTENSION );
	$filename  = ucwords( pathinfo( $value, PATHINFO_FILENAME ) );
	$extension = strtolower( $extension );
	$the_value = strtolower( $filename );

	if ( $extension == 'png' ) {
		$data = array(
			'label' => "$filename",
			'value' => "$the_value",
		);

		array_push( $transparent_images, $data );
	}
}
?>

<!-- Modal add and edit -->
<div id='sslider-add-slide-modal' class="fullscreen-modal-content" style="display:none;" title="Add / Edit Slide">
	<form id='sslider-modal-form'>
		<div class="media-frame-menu">
			<div class="media-menu sslider-tabs">
				<div class="switch">
					<a href="#" class="switch-off"></a>
				</div>
				<a class="media-menu-item active" id='opt-title-tab' href='#opt-title'><?php _e( 'Title', SANGAR_SLIDER ); ?></a>
				<a class="media-menu-item opt-background-tab" id='opt-background-tab' href='#opt-background'><?php _e( 'Background', SANGAR_SLIDER ); ?></a>
				<a class="media-menu-item" id='opt-content-tab' href='#opt-content'><?php _e( 'Content', SANGAR_SLIDER ); ?></a>
				<a class="media-menu-item" id='opt-content-options-tab' href='#opt-content-options'><?php _e( 'Content Options', SANGAR_SLIDER ); ?></a>
				<a class="media-menu-item" id='opt-content-style-tab' href='#opt-content-style'><?php _e( 'Content Style', SANGAR_SLIDER ); ?></a>
				<a class="media-menu-item" id='opt-content-animation-tab' href='#opt-content-animation'><?php _e( 'Animation', SANGAR_SLIDER ); ?></a>
				<a class="media-menu-item" id='opt-presets-tab' href='#opt-presets'><?php _e( 'Preset', SANGAR_SLIDER ); ?><span class="pro-label">PRO</span></a>
				<a class="media-menu-item" id='opt-layer-tab' href='#opt-layer'><?php _e( 'Layer Editor', SANGAR_SLIDER ); ?><span class="pro-label">PRO</span></a>
				<a class="media-menu-item" id='opt-mobile-tab' href='#opt-mobile'><?php _e( 'Mobile Editor', SANGAR_SLIDER ); ?><span class="pro-label">PRO</span></a>
			</div>
		</div>
		<div class="sslider-modal-post">
			<div id='opt-title' class="media-frame-content group">
				<div class="settings-container" >
				<div class="sidebar-content widgets-sortables clearfix">
					<input type="text" name="slide-title" id="sslider-title" placeholder="Slide Title" value="">
				</div>
				</div>
			</div>

			<div id='opt-background' class="media-frame-content group">
				<div class="settings-container" >
				<div class="sidebar-content widgets-sortables clearfix" style="padding-bottom: 150px;">
					<table class="table-content">
					<?php require plugin_dir_path( __FILE__ ) . 'modal-background.php'; ?>
					</table>
				</div>
				</div>
			</div>

			<div id='opt-content' class="media-frame-content group">
				<div class="settings-container" >
				<div class="sidebar-content widgets-sortables clearfix">
					<table class="table-content">
						<?php require plugin_dir_path( __FILE__ ) . 'modal-content.php'; ?>
					</table>
				</div>
				</div>
			</div>

			<div id='opt-content-options' class="media-frame-content group">
				<?php require plugin_dir_path( __FILE__ ) . 'modal-content-options.php'; ?>
			</div>

			<div id='opt-content-style' class="media-frame-content group">
				<?php require plugin_dir_path( __FILE__ ) . 'modal-content-style.php'; ?>
			</div>

			<div id='opt-content-animation' class="media-frame-content group">
				<?php require plugin_dir_path( __FILE__ ) . 'modal-content-animation.php'; ?>
			</div>

			<div id='opt-presets' class="media-frame-content group">
				<div class="settings-container" >
					<?php require plugin_dir_path( __FILE__ ) . 'modal-presets.php'; ?>
				</div>
			</div>

			<div id='opt-layer' class="media-frame-content group">
				<div class="settings-container" >
				<div class="sidebar-content widgets-sortables clearfix">
					<?php require plugin_dir_path( __FILE__ ) . 'modal-layer.php'; ?>
				</div>
				</div>
			</div>

			<div id='opt-mobile' class="media-frame-content group">
				<div class="settings-container" >
				<div class="sidebar-content widgets-sortables clearfix">
					<?php require plugin_dir_path( __FILE__ ) . 'modal-mobile.php'; ?>
				</div>
				</div>
			</div>

		</div>
		<div class="media-sidebar">
			<div class="modal-sidetips" id="sidetips-title">
				<h3>Title</h3>
				<p>
					Your slide title.
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-background">
				<h3>Background</h3>
				<p>
					<strong>Background Type</strong>
					<p>
						<ul>
							<li><strong>Image</strong>: Image type background will display static image as background. Bigger images is better.</li>
							<li><strong>Solid Color</strong>: Solid Color is for one static color as a background</li>
							<li><strong>Video</strong>: Using HTML5 video as a background</li>
							<li><strong>HTML</strong>: Using raw HTML as a background, if you need more control for your slides.</li>
						</ul>
					</p>
					<p>
						<strong>Image Hyperlinks</strong>
					<p>
						The image hyperlink field is used when you click on an image in the slider.
					</p>
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-content">
				<h3>Content</h3>
				<strong>Content Description</strong>
				<p>
					<ul>
						<li><strong>Text</strong>: Text type content if you wanto add text only content inside your slider.</li>
						<li><strong>Text and Button</strong>: Same as Text type content, with addtional button extras.</li>
						<li><strong>HTML</strong>: Using raw HTML as a content type, if you need more control for your slides.</li>
					</ul>
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-content-options">
				<h3>Content Options</h3>
				<strong>Content Position</strong>
				<p>
					Adjust content position and width to fit your needs. Just make sure the text readability is good, by using contrast background and text.

					<ul>
						<li><strong>Transparent</strong>: Use transparent color for HTML content background with opacity</li>
						<li><strong>Solid Color</strong>: Use solid color for HTML content background</li>
					</ul>
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-content-style">
				<h3>Content Style</h3>
				<strong>Title & Content Desc</strong>
				<p>
					<strong>These options if for Content Box Title/Heading</strong>
					<ul>
						<li><strong>Align</strong>: The horizontal position of your slider content.</li>
						<li><strong>Size</strong>: The size of your slider content box.</li>
						<li><strong>Color</strong>: The color of your slider content box.</li>
						<li><strong>Font</strong>: In case you want to use custom font, choose from this box</li>
						<li><strong>Background</strong>: Choose background type for your content box.</li>
						<li><strong>Padding</strong>: Set padding/length/range beetwen content and edge of your content box, based on size or custom size.</li>
					</ul>
					<strong>These options if for Content Box Content/Description</strong>
					<ul>
						<li><strong>Align</strong>: The horizontal position of your slider content.</li>
						<li><strong>Size</strong>: The size of your slider content box.</li>
						<li><strong>Color</strong>: The color of your slider content box.</li>
						<li><strong>Font</strong>: In case you want to use custom font, choose from this box</li>
						<li><strong>Background</strong>: Choose background type for your content box.</li>
						<li><strong>Padding</strong>: Set padding/length/range beetwen content and edge of your content box, based on size or custom size.</li>
					</ul>
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-content-animation">
				<h3>Animation</h3>
				<strong>Animation Settings</strong>
				<p>
					Enable animation for better user experience. Animation duration is in milliseconds, and animation stagger is animation delay time beetwen items.
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-presets">
				<h3>Presets</h3>
				<p>
					Preset is a predefined layer content for your current slide.
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-layer">
				<h3>Layer Editor</h3>
				<p>
					Add and edit content with ease. You can live preview every change you made. Sangar Slider layer supports multiple content types: Text, Image, Video, HTML, and button.
				</p>
			</div>

			<div class="modal-sidetips" id="sidetips-mobile">
				<h3>Mobile Editor</h3>
				<p>
					Add and edit content with ease. You can live preview every change you made. Sangar Slider layer supports multiple content types: Text, Image, Video, HTML, and button.
				</p>
			</div>
		</div>
	</form>
</div>


<!-- Modal Youtube -->
<div id='sslider-add-youtube-slide-modal' style="display:none;">
	<table class="table-content" style="width:100%">
		<tr valign="top">
			<th scope="row">Title</th>
			<td>
				<input type="text" name="slide-title" placeholder="Slide Title" value="" style="width:100%;">
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">Embed Source</th>
			<td>
				<input type="text" name="tab-bg-video-iframe" placeholder="Put your source url here" value="" style="width:100%;">
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">&nbsp;</th>
			<td id="video-iframe-preview"></td>
		</tr>
	</table>
</div>
