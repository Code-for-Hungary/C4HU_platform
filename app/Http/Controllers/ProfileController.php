<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
	/**
	* profile képenyő
	* @param Request $request
	* @return string full HTML page
	*/	
	public function form(Request $request) {
	    $result = '';
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	        $model = new Profile();
	        $profile = $model->getById($user->id);
	        $result = view('profile',["sysadmin" => $profile->sysadmin,
	            "voluntary" => $profile->voluntary,
	            "web_site_owner" => $profile->web_site_owner,
	            "publicinfo" => $profile->publicinfo,
	            "sysadmin" => $profile->sysadmin,
	            "popupHeader" => __('profile.sure'),
	            "popupBody" => __('profile.delete'),
	            "popupYesDanger" => 1,
	            "popupYesUrl" => \URL::to('/profiledel'),
	            "popupNoUrl" => \URL::to('/profile')
	        ]);
	    }
	    return $result;
	}
	
	/**
	* profil képernyő tárolása
	* @param Request $request
	* @return string full HTML page
	*/
	public function save(Request $request): string {
	    $result = '';
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	        $model = new Profile();
	        $profile = $model->getById($user->id);
	        $profile->volutary = $request->input('voluntary',0);
	        $profile->web_site_owner = $request->input('web_site_owner',0);
	        $profile->publicinfo = $request->input('publicinfo','').' ';
	        User::where('id','=',$user->id)->update([
	            "avatar" => $request->input('avatar','')
	        ]);
	        $result = view('welcome',["msg" => __('profile.saved'), "msgClass" => "alert-success"]);
	    }
	    return $result;
	}
	
	/**
	 * bejelentkezett user account logikai törlése --> welcome
	 * sysadmin nem törölhető!
	 * @param Request $request
	 */
	public function delete(Request $request): string {
	    return '';
	}
	
	/**
	 * sysadminok listája --> sysadmins. Csak akkor müködik ha a bejelentkezett user sysadmin
	 * item akció: delete
	 * akció: add
	 * @param Request $request
	 */
	public function sysadmins(Request $request) {
	    $result = '';
	    $user = \Auth::user();
	    if ($user) {
	        $model = new Profile();
	        $profile = $model->getById($user->id);
	        if ($profile->sysadmin == 1) {
	            $items = $model->getSysadmins();
	            $result = view('sysadmins',["items" => $items]);
	        } else {
	            $result = view('welcome',["msg" => __('profile.access_violation'), "msgClass" => "alert-danger"]);
	        }
	    } else {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    }
	    return $result;
	}
	
	/**
	 * set/unset sysadmin --> sysadmins. Csak akkor müködik ha a bejelentkezett
	 * user sysadmin
	 * saját sysadmin jogát nem törölheti
	 * @param Request $request
	 * @param string\int $value - törlésnél id, felvitelnél email
	 * @param string $action  'del' | 'add'
	 */
	public function setsysadmin(Request $request, $value="", $action="") {
	    $user = \Auth::user();
	    if ($action == 'add') {
	       $value = $request->input('value');
	    }
	    if ($user) {
	        $model = new Profile();
	        $profile = $model->getById($user->id);
	        if ($profile->sysadmin == 1) {
	            $result = view('profile');
	            if ($action == 'add') {
	                $u = User::where('email','=',$value)->first();
	                if ($u) {
	                    $profile = $model->getById($u->id);
	                    $profile->sysadmin = 1;
	                    $model->saveRec($profile);
	                    $items = $model->getSysadmins();
	                    $result = view('sysadmins', ["items" => $items]);
	                } else {
	                    $items = $model->getSysadmins();
	                    $result = view('sysadmins',
	                        ["msg" => __("profile.notfound"), "msgClass" => "alert-danger", "items" => $items]);
	                }
	            }
	            if ($action == 'del') {
	                if ($value != $user->id) {
    	                $u = User::where('id','=',$value)->first();
    	                if ($u) {
    	                    $profile = $model->getById($u->id);
    	                    $profile->sysadmin = 0;
    	                    $model->saveRec($profile);
    	                    $items = $model->getSysadmins();
    	                    $result = view('sysadmins',["items" => $items]);
    	                } else {
    	                    $items = $model->getSysadmins();
    	                    $result = view('sysadmins',
    	                        ["msg" => __("profile.notfound"), "msgClass" => "alert-danger", "items" => $items]);
    	                }
	                } else {
	                    $result = view('profile',["msg" => __('profile.access_violation'), "msgClass" => "alert-danger"]);
	                }
	            }
	        } else {
	            $result = view('welcome',["msg" => __('profile.access_violation'), "msgClass" => "alert-danger"]);
	        }
	    } else {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    }
	    return $result;
	}
	
}
