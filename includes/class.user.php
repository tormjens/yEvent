<?php
/**
* yEvent - User Class
* @author Tor Morten Jensen
* @since 0.0.1
*/

class user {

	public function __construct() {

	}

	public function get_user($id = false) {

		if(!$id)
			return false;

		global $yedb;

		$user = $yedb->single(
			'users', 
			array(
				'ID' => $id
			)
		);

		if($user) {
			$object = new stdClass();
			$object->ID = $user->ID;
			$object->email = $user->email;
			$object->first_name = $user->first_name;
			$object->last_name = $user->last_name;
			$object->registered = $user->registered;
			$object->lastlogin = $user->lastlogin;
			$object->lastevent = $user->lastevent;

			return $object;
		}

		return false;
	}
}

$yeuser = new user;