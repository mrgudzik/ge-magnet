<?php
/**
 * @package ge-magnet
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController{

	// підключення сторінок з налаштуваннями
	public function adminDashboard(){ 
		return require_once( $this->plugin_path . "/templates/admin.php" ); 
	}

	public function adminCpt()
	{
		return require_once( $this->plugin_path . "/templates/cpt.php" );
	}

	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}

	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}

	public function adminGallery()
	{
		echo "<h1>Gallery Manager</h1>";
	}

	public function adminTestimonial()
	{
		echo "<h1>Testimonial Manager</h1>";
	}

	public function adminTemplates()
	{
		echo "<h1>Templates Manager</h1>";
	}

	public function adminAuth()
	{
		echo "<h1>Templates Manager</h1>";
	}

	public function adminMembership()
	{
		echo "<h1>Membership Manager</h1>";
	}

	public function adminChat()
	{
		echo "<h1>Chat Manager</h1>";
	}

	// колбек-функція для додаткової обробки інформації, яку отримуємо з фоми
	// зараз вона просто повертає необроблену інформацію, 
	// і зараз вона поки загальна для всіх полів, але в залежності від типу поля і потрібної обробки її тре міняти 
	// public function magnetOptionsGroup( $input ){
	// 	return $input;
	// }	

	// // колбек для виведення якоїсь додаткової інфи на сторінку г
	// public function magnetAdminSection(){
	// 	echo 'Check this beautiful section!';
	// }

	// колбеки для відображення полів для головної сторінки налаштувань
	// public function magnetAdminField1(){
	// 	$value = esc_attr( get_option( 'text_example' ) );
	// 	echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="text example" >';
	// }
	// public function magnetAdminField2(){
	// 	$value = esc_attr( get_option( 'text_example2' ) );
	// 	echo '<input type="text" class="regular-text" name="text_example2" value="' . $value . '" placeholder="text example 2" >';
	// }

}