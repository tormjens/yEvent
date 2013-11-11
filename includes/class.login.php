<?php
/**
* yEvent - Login Class
* @author Tor Morten Jensen
* @since 0.0.1
*/

class login {

	var $timeout = 7200;

	public function __construct() {

	}

	public function check($email = false, $password = false) {

		global $hash, $yedb;

		if(!$email or !$password)
			return false;

		$user = $yedb->single(
			'users', 
			array(
				'email' => $email
			)
		);

		if($user) {

			$check = $hash->CheckPassword($password,$user->password);

			if($check)
				return $user->ID;

		}

		return false;

	}

	public function auth($email = false, $password = false) {

		global $user, $yedb;

		if(!$email or !$password)
			return false;

		$loggedIn = $_SESSION['loggedIn'];

		if(!$loggedIn) {

			$check = $this->check($email, $password);
			if($check) {
				$_SESSION['loggedIn'] = true;
				$_SESSION['user_ID'] = $check;
				$_SESSION['logintime'] = time();
				return true;
			}
		}

		return false;
	}

	public function is_logged_in() {

		$loggedIn = $_SESSION['loggedIn'];

		if($loggedIn) 
			return true;

		return false;

	}

	public function timeout() {

		$loggedIn = $_SESSION['loggedIn'];

		if($loggedIn) {

			$logintime = $_SESSION['logintime'];
			$now = time();

			if( ($logintime + $this->timeout) < $now ) {
				$_SESSION['logintime'] = time();
			}
			else {
				session_destroy();
				redirect( 'login.php?loggedout=true&return=' . attach_url() );
				exit;
			}

		}

	}

}

$login = new login;
$login->timeout();