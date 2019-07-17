<?php
/**
 * Form Library
 *
 * @author Haris Ainur Rozak
 */

if ( ! class_exists( 'tonjooFormLibrary' ) ) {
	class tonjooFormLibrary {

		function __construct() {
			// silent
		}

		public function print_select( $arr_data = array(), $name = '', $value = '', $attr = '' ) {
			$print_select  = '';
			$print_select .= "<select name='$name' $attr>";

			foreach ( $arr_data as $data ) {
				$selected    = $data['value'] == $value ? 'selected' : '';
				$inside_attr = ! empty( $data['attr'] ) ? $data['attr'] : '';

				$print_select .= "<option value='{$data['value']}' $selected $inside_attr >{$data['label']}</option>";
			}

			$print_select .= '</select>';

			echo $print_select;
		}

		public function print_multiselect( $arr_data = array(), $name = '', $value = array(), $attr = '' ) {
			$print_select  = '';
			$print_select .= "<select name='$name' multiple='multiple' $attr>";

			foreach ( $arr_data as $data ) {
				$selected = in_array( $data['value'], $value ) ? 'selected' : '';

				$print_select .= "<option value='{$data['value']}' $selected >{$data['label']}</option>";
			}

			$print_select .= '</select>';

			echo $print_select;
		}

		public function print_radio( $arr_data = array(), $name = '', $value = '', $attr = '' ) {
			$print_select = '';

			foreach ( $arr_data as $data ) {
				$selected = $data['value'] == $value ? 'checked' : '';

				$print_select .= "<input type='radio' name='$name' value='{$data['value']}' $selected $attr> {$data['label']}<br>";
			}

			echo $print_select;
		}

		public function print_checkbox( $arr_data = array(), $attr = '' ) {
			$print_select = '';

			foreach ( $arr_data as $data ) {
				$selected = $data['value'] == $data['saved_value'] ? 'checked' : '';

				$print_select .= "<input type='checkbox' name='{$data['name']}' value='{$data['value']}' $selected $attr> {$data['label']}<br>";
			}

			echo $print_select;
		}
	}
}
