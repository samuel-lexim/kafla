<?php
/**
 * List of google font used by tonjoo's plugins
 */

if ( ! class_exists( 'tonjooGoogleFonts' ) ) :

	class tonjooGoogleFonts {

		public static $fonts = array(
			'Roboto'            => 'Roboto:400,700',
			'Roboto Condensed'  => 'Roboto+Condensed:400,700',
			'Montserrat'        => 'Montserrat:700,400',
			'Lato'              => 'Lato:400,700',
			'Oswald'            => 'Oswald:400,700',
			'Raleway'           => 'Raleway:400,700',
			'Droid Serif'       => 'Droid+Serif:400,700',
			'Playfair Display'  => 'Playfair+Display:400,700',
			'Merriweather'      => 'Merriweather:400,700',
			'Merriweather Sans' => 'Merriweather+Sans:400,700',
			'Vidaloka'          => 'Vidaloka',
			'EB Garamond'       => 'EB+Garamond',
			'Dancing Script'    => 'Dancing+Script:400,700',
			'Open Sans'         => 'Open+Sans:400,700',
			'Lobster'           => 'Lobster',
			'Lobster Two'       => 'Lobster+Two:400,700',
			'Grand Hotel'       => 'Grand+Hotel',
			'Pacifico'          => 'Pacifico',
			'Crafty Girls'      => 'Crafty+Girls',
			'Bevan'             => 'Bevan',
			'Bitter'            => 'Bitter:400,700',
			'Roboto Slab'       => 'Roboto+Slab:400,700',
			'Ubuntu'            => 'Ubuntu:300,700',
		);

		public static function select() {
			$select_opt = array(
				'0' => array(
					'value' => '',
					'label' => 'Use Content Font',
				),
			);

			foreach ( self::$fonts as $key => $value ) {
				$select_opt[] = array(
					'label' => $key,
					'value' => $key,
				);
			}

			return $select_opt;
		}
	}

endif;
