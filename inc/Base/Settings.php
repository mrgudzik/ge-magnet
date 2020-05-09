<?php
/**
 * @package ge-magnet
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class Settings extends BaseController{

	public function register(){
		add_filter( "plugin_action_links_" . $this->plugin, array ($this, 'settings_links') );
	}

	public function settings_links( $links ){
		$settings_link = '<a href="admin.php?page=magnet_plugin">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}

}	