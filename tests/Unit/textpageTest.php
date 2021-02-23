<?php
namespace Tests\Unit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
include 'app/Http/Controllers/TextpageController.php';
class textpageTest extends TestCase
{
    public function test_form_found()
    {
        $c = new \App\Http\Controllers\TextpageController();
        $request = RequestWithSession::create('/store', 'POST',[]);
        $request->withSession();
        $result = $c->show( $request, 'policy1' );
        $this->assertEquals('textpage//var/www/html/LaravelSocialite/resources/lang/hu/policy1.html',$result);
    }
    public function test_form_notFound()
    {
        $c = new \App\Http\Controllers\TextpageController();
        $request = RequestWithSession::create('/store', 'POST',[]);
        $request->withSession();
        $result = $c->show( $request, '123' );
        $this->assertEquals('Fatal error /var/www/html/LaravelSocialite/resources/lang/en/123.html not found',$result);
    }
}
?>

