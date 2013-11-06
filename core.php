<?php
/**
* yEvent - Core Files
* @author Tor Morten Jensen
* @since 0.0.1
*/

/*
 * Classes
 */

include_once( SYSDIR . '/includes/class.query.php' );
include_once( SYSDIR . '/includes/class.password.php' );
include_once( SYSDIR . '/includes/class.user.php' );
include_once( SYSDIR . '/includes/class.login.php' );

/*
 * Functions
 */

include_once( SYSDIR . '/includes/localization.php' );
include_once( SYSDIR . '/includes/misc.php' );

/*
 * Initiate some of the classes
 */

$hash = new PasswordHash(8, TRUE);
