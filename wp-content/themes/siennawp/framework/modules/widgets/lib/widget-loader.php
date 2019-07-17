<?php

if(!function_exists('sienna_mikado_register_widgets')) {

	function sienna_mikado_register_widgets() {

		$widgets = array(
			'SiennaMikadoLatestPosts',
			'SiennaMikadoSearchOpener',
			'SiennaMikadoSideAreaOpener',
			'SiennaMikadoStickySidebar',
			'SiennaMikadoSocialIconWidget',
			'SiennaMikadoSeparatorWidget',
			'SiennaMikadoHtmlWidget'
		);

		foreach($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'sienna_mikado_register_widgets');