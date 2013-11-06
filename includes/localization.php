<?php
/**
* yEvent - Localization
* @author Tor Morten Jensen
* @since 0.0.1
*/

function init_locale($lang, $dir) {
	putenv("LC_ALL=$lang");
	setlocale(LC_ALL, $lang);

	bindtextdomain("yEvent", $dir);

	textdomain("yEvent");
}

function _e($string) {
	echo _($string);
}
