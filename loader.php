<?php
/**
* yEvent - Loader
* @author Tor Morten Jensen
* @since 0.0.1
*/

/*
 * Start a new session
 */

session_start();

/*
 * Get the configuration file
 */
include_once( SYSDIR . '/config.php' );

/*
 * Get the core file
 */
include_once( SYSDIR . '/core.php' );

/*
 * Initialize languages
 */

init_locale( LANG, SYSDIR . '/langauges' );

/*
 * Establish a connection to the database
 */

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);


?>