<?php
/**
 * @package ge-magnet
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class Enqueue extends BaseController{

	public function register(){
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ));
	}

	function enqueue(){

		
		// css
		wp_enqueue_style( 'magnetstyle', $this->plugin_url . 'css/style.css', array(), false );


		// js
		wp_enqueue_script( 'media-upload' );

		wp_enqueue_media();

		wp_enqueue_script( 'magnetscript', $this->plugin_url . 'js/scripts.min.js', array(), false );


		// libs
		wp_enqueue_style( 'pr-css', $this->plugin_url . 'src/libs/prettify/prettify.css', array(), false );
		wp_enqueue_script( 'PR',	$this->plugin_url . 'src/libs/prettify/prettify.js', array(), false );
	}

}	