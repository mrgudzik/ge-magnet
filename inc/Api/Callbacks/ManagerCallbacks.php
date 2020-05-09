<?php
/**
 * @package ge-magnet
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController{

	// колбек-функція для додаткової обробки інформації, яку отримуємо з фоми
	// зараз вона просто повертає необроблену інформацію, 
	// і зараз вона поки загальна для всіх полів, але в залежності від типу поля і потрібної обробки її тре міняти 
	public function checkboxSanitize( $input ){

		$output = array();

		// return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
		// return ( isset($input) ? true : false );

		foreach ( $this->managers as $key => $value ) {
			$output[$key] = isset($input[$key]) ? true : false ;
		}

		return $output;
	
	}	

	// // колбек для виведення якоїсь додаткової інфи на сторінку г
	public function adminSectionManager(){
		echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
	}


	// колбеки для відображення полів для головної сторінки налаштувань
	public function checkboxesField( $args ){

		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option( $option_name );

		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? 'checked' : '') : false;

     echo '<div class="switch">
            <input id="' . $name . '"  name="' . $option_name . '[' . $name . ']" class="cmn-toggle cmn-toggle-round" type="checkbox"  '. ( $checked ? 'checked' : '' ) .' ">
            <label for="' . $name . '"></label>
          </div>';
	}

}