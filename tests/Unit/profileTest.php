<?php
namespace Tests\Unit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use Tests\TestCase;
include 'app/Http/Controllers/ProfileController.php';
class profileTest extends TestCase
{
    protected function setUp(): void
	{
	    parent::setUp();
	    $this->c = new \App\Http\Controllers\ProfileController();
	}
	
	protected function tearDown(): void
	{
	   parent::tearDown();
	}
	
	public function test_form_logged_notfound()
	{
	    global $logged;
	    $logged = true;
	    
	    // test userhez tartozó profile rekord törlése
	    $users = DB::select('select * from users where email = "user1@test.hu"');
	    if (count($users) > 0) {
	        DB::statement('DELETE FROM `profile` where id='.$users[0]->id);
	    }
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->form( $request );
	    // (a fenti hivás újra létrehozta a test userhez tartozó profile rekordot)
	    $this->assertEquals('profile',$result);
	}
	
	public function test_form_logged_found()
	{
	    global $logged;
	    $logged = true;
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->form( $request );
	    $this->assertEquals('profile',$result);
	}
	
	public function test_form_notlogged()
	{
	    global $logged;
	    $logged = false;
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->form( $request );
	    $this->assertEquals('welcome',$result);
	}
	
	public function test_save_logged()
	{
	    global $logged;
	    $logged = true;
	    $request = RequestWithSession::create('/store', 'POST',[
	        "voluntary" => "1",
	        "avatar" => "",
	        "web_site_owner" => "1",
	        "publicinfo" => "123456789"
	    ]);
	    $request->withSession();
	    $result = $this->c->save( $request );
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('profil adatok tárolva',viewP('msg'));
	}
	
	public function test_save_notlogged()
	{
	    global $logged;
	    $logged = false;
	    $request = RequestWithSession::create('/store', 'POST',[
	        "voluntary" => "1",
	        "avatar" => "",
	        "web_site_owner" => "1",
	        "publicinfo" => "123456789"
	    ]);
	    $request->withSession();
	    $result = $this->c->save( $request );
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('nincs bejelentkezve',viewP('msg'));
	}
	
	public function test_sysadmins_notlogged() {
	    global $logged;
	    $logged = false;
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->sysadmins( $request );
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('nincs bejelentkezve',viewP('msg'));
	}
	
	public function test_sysadmins_notsysadmin() {
	    global $logged;
	    $logged = true;
	    
	    // test user nem sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 0;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->sysadmins( $request );
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('Ez a funkció neked nem engedélyezett',viewP('msg'));
	}
	
	public function test_sysadmins_ok() {
	    global $logged;
	    $logged = true;
	    
	    // test user sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 1;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->sysadmins( $request );
	    $this->assertEquals('sysadmins',$result);
	}
	
	public function test_setsysadmin_notlogged() {
	    global $logged;
	    $logged = false;
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->setsysadmin( $request, '', '');
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('nincs bejelentkezve',viewP('msg'));
	}
	
	public function test_setsysadmin_notsysadmin() {
	    global $logged;
	    $logged = true;
	    
	    // test user nem sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 0;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->setsysadmin( $request, '', '' );
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('Ez a funkció neked nem engedélyezett',viewP('msg'));
	}
	
	public function test_setsysadmin_self() {
	    global $logged;
	    $logged = true;
	    
	    // test user sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 1;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->setsysadmin( $request, $user->id, 'del' );
	    $this->assertEquals('profile',$result);
	    $this->assertEquals('Ez a funkció neked nem engedélyezett',viewP('msg'));
	}
	
	public function test_setsysadmin_notfound() {
	    global $logged;
	    $logged = true;
	    
	    // test user sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 1;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->setsysadmin( $request, 'notfound@test.hu', 'add' );
	    $this->assertEquals('sysadmins',$result);
	    $this->assertEquals('Nincs ilyen felhasználó.',viewP('msg'));
	}
	
	
	public function test_setsysadmin_ok() {
	    global $logged;
	    $logged = true;
	    
	    // test user sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 1;
	    $profileModel->saveRec($profile);
	    
	    // insert user2 test user
	    $user2 = DB::select('select * from users where email = "user2@test.hu"');
	    if (!$user2) {
	        DB::statement('INSERT INTO users (name,email) values ("user2", "user2@test.hu")');
	    }
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $request->withSession();
	    $result = $this->c->setsysadmin( $request, 'user2@test.hu', 'add' );
	    $this->assertEquals('sysadmins',$result);
	}
	
	public function test_delete_notlegged() {
	    global $logged;
	    $logged = false;
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $result = $this->c->delete($request);
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('Ez a funkció neked nem engedélyezett', viewP('msg'));
	}
	
	public function test_delete_sysadmin() {
	    global $logged;
	    $logged = true;
	    
	    // test user sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 1;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $result = $this->c->delete($request);
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('Ez a funkció neked nem engedélyezett', viewP('msg'));
	}
	
	public function test_delete_ok() {
	    global $logged;
	    $logged = true;
	    
	    // test user not sysadmin
	    $user = \Auth::user();
	    $profileModel = new Profile();
	    $profile = $profileModel->getByEmail($user->email);
	    $profile->sysadmin = 0;
	    $profileModel->saveRec($profile);
	    
	    $request = RequestWithSession::create('/store', 'GET',[]);
	    $result = $this->c->delete($request);
	    $this->assertEquals('welcome',$result);
	    $this->assertEquals('welcome',$result);
	}
	
	
}
?>

