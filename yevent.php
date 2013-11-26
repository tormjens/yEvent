<?php
/*
Plugin Name: yEvent
Plugin URI: http://yevent.im
Description: A event management system for WordPress.
Version: 0.1
Author: Tor Morten Jensen
Author URI: http://tormorten.no
*/

/**
 * Copyright (c) 2013 Tor Morten Jensen. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

if(!defined('PLUGIN_PATH'))
	define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));

if(!defined('PLUGIN_URL'))
	define('PLUGIN_URL', plugins_url( '/', __FILE__ ));

/**
 * The plugin files
 * @since 	0.1
 */

require_once( PLUGIN_PATH . '/classes/class.yevent.php'); // main plugin class
require_once( PLUGIN_PATH . '/classes/class.ticket.php' ); // ticket handling
require_once( PLUGIN_PATH . '/classes/class.events.php'); // event handling
require_once( PLUGIN_PATH . '/classes/class.adminpages.php' ); // the admin pages
require_once( PLUGIN_PATH . '/classes/class.gateway.php'); // payment handling
require_once( PLUGIN_PATH . '/classes/class.backend.php'); // the backend

/**
 * Activation/deactivation of the plugin
 * @since 	0.1
 */

register_activation_hook( __FILE__, array('yEvent', 'plugin_install') );
register_deactivation_hook( __FILE__, array('yEvent', 'plugin_uninstall') );

/**
 * Initiate the plugin
 * @since 	0.1
 */

add_action( 'plugins_loaded', array( 'yEvent', 'get_instance' ) );

?>