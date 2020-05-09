<?php
/**
 * @package ge-magnet
 * @version 1.0.0
 */

/*
Plugin Name: GE Magnet
Plugin URI: http://gudzik.com/plugins/ge-magnet/
Description: This is my ge-magnet plugin.
Author: Andrij Gudzovskyj
Version: 1.0.0
Author URI: http://gudzik.com/
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, you cant access this file, you silly human!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' )){
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define CONSTANTS
// define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
// define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
// define( 'PLUGIN', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation
 */
function activate_magnet_plugin(){
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_magnet_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_magnet_plugin(){
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_magnet_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ){
	Inc\Init::register_services();
}