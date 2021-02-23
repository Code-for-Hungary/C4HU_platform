<?php
namespace Tests\Unit;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class SessionMock extends Session {
	public static function regenerateToken() {
	}
}

class RequestWithSession extends \Illuminate\Http\Request {
	function withSession() { 
		$this->session = new SessionMock(new MockArraySessionStorage());
	}
}
?>
