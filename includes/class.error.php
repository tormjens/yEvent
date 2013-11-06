<?php
/**
* yEvent - Error Class
* @author Tor Morten Jensen
* @since 0.0.1
*/

class error {

	public $prefix = DB_PREFIX;

	public function __construct() {



	}

	public function error($single) {

		$this->error = $single;

	}

}

$error = new error;