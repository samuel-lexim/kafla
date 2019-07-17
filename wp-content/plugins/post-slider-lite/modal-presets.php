<?php
$presets = apply_filters('sangar_slider_presets',array());

// no-preset by default
$no_preset_image = plugin_dir_url( __FILE__ ) . 'presets/no-preset.png';
$preset = '{"desktop":{"number":0,"options":{},"content":[]},"mobile":{"number":0,"options":{},"content":[]}}';
$preset = base64_encode($preset);

echo <<<EOT
	<div class="sslider-preset-items" data-id="no-preset" data-font="">
		<img src="$no_preset_image">
		<span style="display:none">$preset</span>
	</div>
EOT;

// foreach, print all presets
foreach ($presets as $key => $value):

$preset = file_get_contents($value['preset'], FILE_USE_INCLUDE_PATH);

$layer_fonts = array();

// get all loaded font
preg_match_all('/font_type":"(.*?)","font_weight/s', $preset, $text_font);
preg_match_all('/text_font":"(.*?)","text_weight/s', $preset, $button_font);

$layer_fonts = array_merge($layer_fonts,$text_font[1],$button_font[1]);
$layer_fonts = base64_encode(json_encode($layer_fonts));

$preset = base64_encode($preset);

echo <<<EOT
	<div class="sslider-preset-items" data-id="$key" data-font="$layer_fonts">
		<img src="{$value['cover']}">
		<span style="display:none">$preset</span>
	</div>
EOT;
endforeach;

echo "<input type='hidden' style='display:none;' name='tab-preset'>";
echo "<textarea style='display:none;' name='slide-layer'></textarea>";
?>