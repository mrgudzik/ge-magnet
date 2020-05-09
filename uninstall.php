<?php

/**
 *
 * Trigger this file on Plugin uninstall
 *
 * @package ge-magnet
 *
 */

if ( ! defined('WP_UNINSTALL_PLUGIN') ){
	die;
}

// Clear database stored data - variant 1
$magnets = get_posts( array( 'post_type' => 'magnet', 'numberposts' => -1 ));

foreach ( $magnets as $magnet ) {
	wp_delete_post( $magnet->ID, true);	
}


// Access the database via SQL - variant 2
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'magnet'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );

//register_uninstall_hook( __FILE__, array( $geMagnet, 'uninstall' ) );
