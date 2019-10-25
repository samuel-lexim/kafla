<?php

class SiennaMikadoStickySidebar extends SiennaMikadoWidget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'mkdf_sticky_sidebar', // Base ID
			'Mikado Sticky Sidebar', // Name
			array('description' => esc_html__('Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar.', 'sienna'),) // Args
		);
		$this->setParams();
	}

	protected function setParams() {

	}

	public function widget($args, $instance) {
		echo '<div class="widget widget_sticky-sidebar"></div>';
	}

}

function registerSiennaMikadoStickySidebar(){
	register_widget( "SiennaMikadoStickySidebar" );
}

add_action('widgets_init', 'registerSiennaMikadoStickySidebar');
