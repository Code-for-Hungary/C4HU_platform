<?php
namespace Tests\Unit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
include 'app/Http/Controllers/EmailVerifyController.php';
class emailverifyTest extends TestCase
{
	protected function setUp(): void
	{
	   parent::setUp();
	   // make test datas into database
	   \DB::statement('delete from users where email="test@test.hu"');
	   \DB::statement('insert into users (name,email) values ("test","test@test.hu")');
	}
	
	protected function tearDown(): void
	{
	   parent::tearDown();
	}
	
    public function test_form_notlogged()
    {
		global $logged;
		$logged = false;
    	$c = new \App\Http\Controllers\EmailVerifyController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->form( $request );
        $this->assertEquals('/',$result);
    }

    public function test_form_logged()
    {
		global $logged;
		$logged = true;
    	$c = new \App\Http\Controllers\EmailVerifyController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->form( $request );
        $this->assertEquals('emailverify/user1@test.hu',$result);
    }

    public function test_send_emailNotFounf()
    {
		global $logged;
		$logged = true;
    	$c = new \App\Http\Controllers\EmailVerifyController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->send( $request, 'notfound@test.hu');
        $this->assertEquals('welcome/notfound@test.hu email not unique or not found,alert-danger',$result);
    }

    public function test_send_emailFound()
    {
		global $logged;
		$logged = true;
    	$c = new \App\Http\Controllers\EmailVerifyController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->send( $request, 'test@test.hu');
        $this->assertEquals('welcome/Aktiváló e-mail elküldve.,alert-info',$result);
    }

    public function test_do_TokenFound()
    {
		global $logged;
		$logged = true;
    	$c = new \App\Http\Controllers\EmailVerifyController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
   		\DB::update('update users set remember_token = "123456789" where email = "test@test.hu"');
    	$result = $c->do( $request, '123456789');
        $this->assertEquals('welcome/e-mail cím ellenörzés sikeres, fiók aktiválva,alert-success',$result);
    }

    public function test_do_TokenNotFound()
    {
		global $logged;
		$logged = true;
    	$c = new \App\Http\Controllers\EmailVerifyController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->do( $request, '123456');
        $this->assertEquals('welcome/invalid token,alert-danger',$result);
    }
    
}
?>

