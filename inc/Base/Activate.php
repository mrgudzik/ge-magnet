<?php
/**
 * @package ge-magnet
 */

namespace Inc\Base;

class Activate
{
	public static function activate() {
		
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'magnet_plugin' ) ) {
			update_option( 'magnet_plugin', $default );
		}

		if ( ! get_option( 'magnet_plugin_cpt' ) ) {
			update_option( 'magnet_plugin_cpt', $default );
		}

		if ( ! get_option( 'magnet_plugin_tax' ) ) {
			update_option( 'magnet_plugin_tax', $default );
		}		

	}
}