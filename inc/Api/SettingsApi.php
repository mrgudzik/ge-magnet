<?php
/**
 * @package ge-magnet
 */

namespace Inc\Api;

class SettingsApi{

	public $admin_pages = array();

	public $admin_subpages = array();

	public $settings = array();
	public $sections = array();
	public $fields = array();

	public function register(){

		if ( !empty( $this->admin_pages ) || !empty( $this->admin_subpages ) ){
			add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
		}

		if ( !empty( $this->settings ) ){
			add_action( 'admin_init', array( $this, 'registerCustomFields' ) );
		}

	}
	// функція що повертає налаштування головної сторінки у $this
	public function addPages(array $pages){
		$this->admin_pages = $pages;

		return $this;
	}
	// функція, що повертає налаштування головної субсторінки у $this 
	public function withSubPage(string $title = null){
		if ( empty($this->admin_pages) ){
			return $this;
		} 
		
		$admin_page = $this->admin_pages[0];

		$subpage =  array([
			'parent_slug' => $admin_page['menu_slug'],
			'page_title' => $admin_page['page_title'], 
			'menu_title' => $title ? $title : $admin_page['menu_title'],
			'capability' => $admin_page['capability'], 
			'menu_slug' => $admin_page['menu_slug'], 
			'callback' => function(){ echo '<h1> Super Magnet Plugin (subpage main) </h1>'; }       
		]);

		$this->admin_subpages = $subpage;

		return $this;

	}

	// функція, що повертає налаштування субсторінок у $this
	public function addSubPages( array $pages ){
		$this->admin_subpages = array_merge($this->admin_subpages, $pages);

		return $this;
	}

	// функції, що додають сторінки та субсторінки
	public function addAdminMenu(){

		foreach ( $this->admin_pages as $page ) {
			add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
		}

		foreach ( $this->admin_subpages as $page ) {
			add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
		}

	}

	// фунції, що повертають поля налаштувань у $this.
	public function setSettings(array $settings ){
		$this->settings = $settings;

		return $this;
	}
 	public function setSections(array $sections ){
		$this->sections = $sections;

		return $this;
	}
	public function setFields(array $fields ){
		$this->fields = $fields;

		return $this;
	}

	// функції, що реєструють поля з налаштуваннями
	public function registerCustomFields(){
		// regiter setting
		foreach ( $this->settings as $setting ) {
			register_setting( $setting["option_group"], $setting["option_name"],  isset($setting["callback"]) ? $setting["callback"] : '' );
		}
		// add setting section
		foreach ( $this->sections as $section ) {
			add_settings_section( $section["id"], $section["title"], isset($section["callback"]) ? $section["callback"] : '', $section["page"] );
		}
		// add setting field
		foreach ( $this->fields as $field ) {
			add_settings_field( $field["id"], $field["title"], isset($field["callback"]) ? $field["callback"] : '', $field["page"], $field["section"], isset($field["args"]) ? $field["args"] : '' );
		}

	}

}