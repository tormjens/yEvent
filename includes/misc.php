<?php
/**
* yEvent - Misc Functions
* @author Tor Morten Jensen
* @since 0.0.1
*/

function attach_url() {

	$pageURL = 'http';

	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return urlencode($pageURL);
}

function redirect($url) {
	ob_start();
	header("Location: $url");
}