<?php
namespace Tests\Unit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
include 'app/Http/Controllers/BugreportController.php';
class bugreportTest extends TestCase
{
	protected function setUp(): void
	{
	    parent::setUp();
	}
	
	protected function tearDown(): void
	{
	   parent::tearDown();
	}
	
    public function test_form()
    {
		global $logged;
		$logged = false;
    	$c = new \App\Http\Controllers\BugreportController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->form( $request );
        $this->assertEquals('bugreport/',$result);
    }

    public function test_send()
    {
		global $logged;
		$logged = true;
    	$c = new \App\Http\Controllers\BugreportController();
    	$request = RequestWithSession::create('/store', 'POST',[]);
   		$request->withSession();
    	$result = $c->send( $request );
        $this->assertEquals('welcome/E-mail elküldve a rendszergazdának. Köszönjük segitségét.,alert-success',$result);
    }
}
?>

