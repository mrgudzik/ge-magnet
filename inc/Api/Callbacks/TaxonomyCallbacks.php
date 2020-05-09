<?php 
/**
 * @package ge-magnet
 */

namespace Inc\Api\Callbacks;

class TaxonomyCallbacks{

	public function taxSectionManager()	{
		echo 'Create as many Taxonomy as you want.';
	}

	public function taxSanitize( $input )	{

		$output = get_option('magnet_plugin_tax');

		if ( isset($_POST["remove"]) ){

			unset($output[$_POST["remove"]]);

			return $output;
		};

		if ( count($output) == 0 ) {
  		$output[$input['taxonomy']] = $input;

			return $output;
		}

		foreach ( $output as $key => $value ) {
			if ( $input['taxonomy'] === $key ) {
				$output[$key] = $input;
			}else{
				$output[$input['taxonomy']] = $input;
			}
		}

		return $output;
	}

	public function textField( $args )	{

		$name = $args['label_for'];
		$placeholder = $args['placeholder'];
		$option_name = $args['option_name'];
		$value = '';

		if ( isset( $_POST["edit_taxonomy"] ) ){

			$input = get_option( $option_name );
			$value = $input[ $_POST["edit_taxonomy"] ][ $name ];

		}

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $placeholder . '">';
	
	}

	public function checkboxField( $args )	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_taxonomy"]) ){
			$checkbox = get_option( $option_name );
	  	$checked = isset( $checkbox[$_POST["edit_taxonomy"]][$name] ) ? : false;
		}

     echo '<div class="' . $classes . '">
            <input id="' . $name . '"  name="' . $option_name . '[' . $name . ']" value="1" class="cmn-toggle cmn-toggle-round" type="checkbox"  '. ( $checked ? 'checked' : '' ) .' ">
            <label for="' . $name . '"></label>
          </div>';

	}


	public function checkboxPostTypesField( $args )
	{
		$output = '';
		$name = $args['label_for'];
		$classes = $args['class']; 
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_taxonomy"]) ) {
			$checkbox = get_option( $option_name );
		}

		$post_types = get_post_types( array( 'show_ui' => true ) );

		foreach ($post_types as $post) {

			if ( isset($_POST["edit_taxonomy"]) ) {
				$checked = isset($checkbox[$_POST["edit_taxonomy"]][$name][$post]) ?: false;
			}

			$output .= '<div class="' . $classes . ' mb-10">
            <input type="checkbox" id="' . $post . '"  name="' . $option_name . '[' . $name . '][' . $post . ']" value="1" class="cmn-toggle cmn-toggle-round" '. ( $checked ? 'checked' : '' ) .' ">
            <label for="' . $post . '"></label><strong>' . $post . '</strong>
          </div>';

		}

		echo $output;
	}


}