<?php
/**
 * @package ge-magnet
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController{

	public $settings;
	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();
	//	public $subpages = array();

	public function register(){

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();

		// робимо масив з параметрами сторінки з субсторінками
		$this->setPages();
	//	$this->setSubPages();
		// запускаємо функції в яких передаємо в відповідні функції класу SettingsApi() всі поля з налаштуваннями які потім повертаються в $this
		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	// функція з масивом параметрів для головної сторінки налаштувань
	public function setPages(){

		$this->pages = array(
			array(
			'page_title' => 'GE Magnet Plugin', 
			'menu_title' => 'GE Magnet', 
			'capability' => 'manage_options', 
			'menu_slug' => 'magnet_plugin', 
			'callback' => array( $this->callbacks, 'adminDashboard' ),
			'icon_url' => 'dashicons-store', 
			'position' => 110
			)
		);
	}

	// функція з масивом параметрів для додаткових сторінок налаштувань
	// public function setSubPages(){

	// 	$this->subpages = array([
	// 		'parent_slug' => 'magnet_plugin',
	// 		'page_title' => 'Custom Post Ttype', 
	// 		'menu_title' => 'CPT',
	// 		'capability' => 'manage_options',
	// 		'menu_slug' => 'magnet_cpt',
	// 		'callback' => array( $this->callbacks, 'cptDashboard' )
	// 	],
	// 	[
	// 		'parent_slug' => 'magnet_plugin',
	// 		'page_title' => 'Custom Post Ttype2', 
	// 		'menu_title' => 'Taxonomy',
	// 		'capability' => 'manage_options',
	// 		'menu_slug' => 'magnet_taxonomy',
	// 		'callback' => array( $this->callbacks, 'taxonomyDashboard' )
	// 	],
	// 	[
	// 		'parent_slug' => 'magnet_plugin',
	// 		'page_title' => 'Custom Post Ttype3', 
	// 		'menu_title' => 'widget',
	// 		'capability' => 'manage_options',
	// 		'menu_slug' => 'magnet_widget',
	// 		'callback' => array( $this->callbacks, 'widgetDashboard' )
	// 	]);
	// }

	// функція з масивом налаштувань (полів) для головної сторінки налаштувань, поля отримуємо з BaseController і перебираємо в циклі
	public function setSettings(){

		$args = array(
			array(
				'option_group' => 'magnet_plugin_settings',
				'option_name' => 'magnet_plugin',
				'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' ) 				
			)
		);

		// $args = array();
		// foreach ($this->managers as $key=>$value) {
		// 	$args[] = array(
		// 		'option_group' => 'magnet_options_settings',
		// 		'option_name' => $key,
		// 		'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' ) 
		// 	);
		// }

		$this->settings->setSettings( $args );
	}

	// функція з масивом для реєстрації секції для головної сторінки налаштувань
	public function setSections(){
		
		$args = array(
			array(
				'id' => 'magnet_admin_index',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'magnet_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	// функція з масивом полів, які виводяться на головній сторінці налаштувань, поля отримуємо з BaseController і перебираємо в циклі
	public function setFields(){

		$args = array();

		foreach ($this->managers as $key=>$value) {
			$args[] = array(

				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_mngr, 'checkboxesField' ),
				'page' => 'magnet_plugin',
				'section' => 'magnet_admin_index',
				'args' => array(
					'option_name' => 'magnet_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}		

		$this->settings->setFields( $args );
	}

}