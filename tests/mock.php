<?php

// =========================== mock =================================
class User {
	public $email = 'user1@test.hu';
	public $name = 'user1';
	public $avatar = '';
	public $id = 1;
}
class Guard {
	public function logout() {}
}
class Auth {
	public static function user() {
		global $logged;
		if ($logged) {
			return new User();
		} else {
			return false;
		}		
	}
	public static function guard() {
		return new Guard();	
	}
	public static function routes() {
	}
}
class URL {
	public static function to($s) {
		return $s;
	}
}
?>
