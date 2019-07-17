<?php
/**
 * Class ssliderDefault
 *
 * @author Haris
 */
class ssliderDefault {

	// ssliderDefault::slide
	public static function slide( $options = array(), $group = false ) {
		$default = apply_filters( 'sangar_slider_default_options_slide', array() );
		$options = is_array( $options ) ? $options : array();

		if ( ! defined( 'SSLIDER_CURRENT_ADDON' ) && $group ) {
			if ( isset( $default[ $group ] ) ) {
				return array_merge( $default[ $group ], $options ); // frontend
			} else {
				return false;
			}
		} else {
			return array_merge( $default, $options );
		}
	}

	// ssliderDefault::config
	public static function config( $options = array(), $group = false ) {
		$default = apply_filters( 'sangar_slider_default_options_config', array() );
		$options = is_array( $options ) ? $options : array();

		if ( ! defined( 'SSLIDER_CURRENT_ADDON' ) && $group ) {
			if ( isset( $default[ $group ] ) ) {
				return array_merge( $default[ $group ], $options ); // frontend
			} else {
				return false;
			}
		} else {
			return array_merge( $default, $options );
		}
	}

	public static function velocityTransition() {
		return array(
			array(
				'value' => 'transition.slideUpIn',
				'label' => 'Slide Up',
			),
			array(
				'value' => 'transition.slideDownIn',
				'label' => 'Slide Down',
			),
			array(
				'value' => 'transition.slideLeftIn',
				'label' => 'Slide Left',
			),
			array(
				'value' => 'transition.slideRightIn',
				'label' => 'Slide Right',
			),
			array(
				'value' => 'transition.fadeIn',
				'label' => 'Fade',
			),
			array(
				'value' => 'transition.slideUpBigIn',
				'label' => 'Slide Up Wide',
			),
			array(
				'value' => 'transition.slideDownBigIn',
				'label' => 'Slide Down Wide',
			),
			array(
				'value' => 'transition.slideLeftBigIn',
				'label' => 'Slide Left Wide',
			),
			array(
				'value' => 'transition.slideRightBigIn',
				'label' => 'Slide Right Wide',
			),
			array(
				'value' => 'transition.flipXIn',
				'label' => 'Flip X',
			),
			array(
				'value' => 'transition.flipYIn',
				'label' => 'Flip Y',
			),
			array(
				'value' => 'transition.flipBounceXIn',
				'label' => 'Flip Bounce X',
			),
			array(
				'value' => 'transition.flipBounceYIn',
				'label' => 'Flip Bounce Y',
			),
			array(
				'value' => 'transition.swoopIn',
				'label' => 'Swoop',
			),
			array(
				'value' => 'transition.whirlIn',
				'label' => 'Whirl',
			),
			array(
				'value' => 'transition.shrinkIn',
				'label' => 'Shrink',
			),
			array(
				'value' => 'transition.expandIn',
				'label' => 'Expand',
			),
			array(
				'value' => 'transition.bounceIn',
				'label' => 'Bounce',
			),
			array(
				'value' => 'transition.bounceUpIn',
				'label' => 'Bounce Up',
			),
			array(
				'value' => 'transition.bounceDownIn',
				'label' => 'Bounce Down',
			),
			array(
				'value' => 'transition.bounceLeftIn',
				'label' => 'Bounce Left',
			),
			array(
				'value' => 'transition.bounceRightIn',
				'label' => 'Bounce Right',
			),
			array(
				'value' => 'transition.perspectiveUpIn',
				'label' => 'Perspective Up',
			),
			array(
				'value' => 'transition.perspectiveDownIn',
				'label' => 'Perspective Down',
			),
			array(
				'value' => 'transition.perspectiveLeftIn',
				'label' => 'Perspective Left',
			),
			array(
				'value' => 'transition.perspectiveRightIn',
				'label' => 'Perspective Right',
			),
		);
	}
}

