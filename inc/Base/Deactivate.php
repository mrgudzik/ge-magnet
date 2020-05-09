<?php
/**
 * @package ge-magnet
 */
namespace Inc\Base;

class Deactivate {
	
	public static function deactivate(){
		flush_rewrite_rules();
	}
}