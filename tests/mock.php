<?php

// =========================== mock =================================
class User {
	public $email = 'user1@test.hu';
	public $name = 'user1';
	public $avatar = '';
	public $id = 2;
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
class Mail {
    public static function send($template, $params, $mailFun) {
    }
}
function viewP($name) {
    global $viewParams;
    if (isset($viewParams[$name])) {
        $result = $viewParams[$name];
    } else {
        $result = '';
    }
    return $result;
}

?>
