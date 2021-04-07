<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Profiles;
use App\Models\Profile_skills;
use App\Models\Skills;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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
	        $modelProfile = new Profiles();
	        $profile = $modelProfile->fullGet($user->id);
			$skills = new \stdClass();
			foreach ($profile->skills as $profile_skill) {
				$skill_id = $profile_skill->id;
				$skills->$skill_id = $profile_skill->level;			
			}	        
	        $skillsModel = new Skills();
	        $result = view('profile',["sysadmin" => $profile->sysadmin,
	            "voluntary" => $profile->voluntary,
	            "project_owner" => $profile->project_owner,
	            "publicinfo" => $profile->publicinfo,
	            "sysadmin" => $profile->sysadmin,
	            "popupHeader" => __('profile.sure'),
	            "popupBody" => __('profile.delete'),
	            "popupYesDanger" => 1,
	            "popupYesUrl" => \URL::to('/profiledel'),
	            "popupNoUrl" => \URL::to('/profile'),
	            "skillsTree" => $skillsModel->getJsonStr(),
	            "skills" => JSON_encode($skills)
	         ]);
	         	    }
	    return $result;
	}
	
	/**
	* profil képernyő tárolása
	* @param Request $request - profil képernyő látható adatai és  skills rejtet mező
	* @return string full HTML page
	*/
	public function save(Request $request): string {
		
		$validated = $request->validate([
        	'password2' =>  Rule::in([$request->input('password')])
    	]);		
		
	    $user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('profile.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	    	
			// jelszómodosítás
			if ($request->input('password') != '') {
				if ($request->input('password') == $request->input('password2')) {
					$user->password = \Hash::make($request->input('password'));
					$user->save();
				} else {
			        $result = view('welcome',["msg" => __('profile.passwords_not_equals'), "msgClass" => "alert-danger"]);
				}			
			}
			
			$profileModel = new Profiles();
			if ($profileModel->saveFormData($user, $request)) {
		        $result = view('welcome',["msg" => __('profile.saved'), "msgClass" => "alert-success"]);
			} else {
		        $result = view('welcome',["msg" => __('profile.database error'), "msgClass" => "alert-danger"]);
			}
	    }
	    return $result;
	}
	
	/**
	 * bejelentkezett user account logikai törlése --> welcome
	 * sysadmin nem törölhető!
	 * @param Request $request
	 */
	public function delete(Request $request): string {
		$user = \Auth::user();
	    if ($user) {
	        $modelProfile = new Profiles();
	        $profile = $modelProfile->where('id','=',$user->id)->first();
	        if ($profile->sysadmin != 1) {
	        	// a user1@test.hu a demo site test usere, ez ne engedjük törölni
	            if ($user->email != 'user1@test.hu') {
	               User::where('id','=',$user->id)->update([
	                "name" => "deleted".$user->id,
	                "email" => "deleted".$user->id."@deleted.hu",
	                "password" => "",
	               ]);
		           $profile->publicinfo = '';
	               $profile->save();
	            }
	            \Auth::guard()->logout();
	            $result = view('welcome',[]);
	        } else {
	        	// sysadmin fiók nem törölhető
	            $result = view('welcome',["msg" => __('profile.access_violation'), "msgClass" => "alert-danger"]);
	        }
	    } else {
	    	// nincs bejelentkezve
	        $result = view('welcome',["msg" => __('profile.access_violation'), "msgClass" => "alert-danger"]);
	    }
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
	        $modelProfile = new Profiles();
	        $profile = $modelProfile->where('id','=',$user->id)->first();
	        if ($profile->sysadmin == 1) {
	            $items = $modelProfile->getSysadmins();
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
	        $modelProfile = new Profiles();
	        $profile = $modelProfile->fullGet($user->id);  // bejelentkezett user profilja
	        if ($profile->sysadmin == 1) {
	            $result = view('profile');
	            if ($action == 'add') {
	                $u = User::where('email','=',$value)->first();
	                if ($u) {
	                    $newProfileModel = new Profiles();
	                    $newProfileModel->fullGet($u->id); // létrehozza ha még nincs
	                    $newProfile = $newProfileModel->where('id','=',$u->id)->first();
	                    $newProfile->sysadmin = 1;
	                    $newProfile->save();
	                    $items = $modelProfile->getSysadmins();
	                    $result = view('sysadmins', ["items" => $items]);
	                } else {
	                    $items = $modelProfile->getSysadmins();
	                    $result = view('sysadmins',
	                        ["msg" => __("profile.notfound"), "msgClass" => "alert-danger", "items" => $items]);
	                }
	            }
	            if ($action == 'del') {
	                if ($value != $user->id) {
    	                $u = User::where('id','=',$value)->first();
    	                if ($u) {
		                    $oldProfileModel = new Profiles();
	                    	$oldProfileModel->fullGet($u->id); // létrehozza ha még nincs
	                    	$oldProfile = $oldProfileModel->where('id','=',$u->id)->first();
    	                    $oldProfile->sysadmin = 0;
    	                    $oldProfile->save();
    	                    $items = $modelProfile->getSysadmins();
    	                    $result = view('sysadmins',["items" => $items]);
    	                } else {
    	                    $items = $modelProfile->getSysadmins();
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
	
	/**
	* Önkéntesek Böngésző
	*/	
	public function indexPaging(Request $request)	{
        $skillsModel = new Skills();
		$skillsTree = $skillsModel->getJsonStr();

		$oldOrderField = $request->session()->get('profilesOrder','users.name');
		$oldOrderDir = $request->session()->get('profilesOrderDir','ASC');
		$orderField = $request->input('orderfield', $oldOrderField);
		$orderDir = $request->input('orderdir', $oldOrderDir);
		$filter = $request->input('filter', $request->session()->get('profilesFilter','[]'));
		if ($oldOrderField == $request->input('orderfield')) {
			if ($orderDir == 'ASC') {
				$orderDir = 'DESC';
			} else {
				$orderDir = 'ASC';
			}
		}
		$request->session()->put('profilesOrder',$orderField);
		$request->session()->put('profilesOrderDir',$orderDir);
		$request->session()->put('profilesFilter',$filter);
		$modelProfile = new Profiles();
		$profiles = $modelProfile->paginateOrderFilter(5, $orderField, $orderDir, $filter);		
	    return view('profile-index-paging',['skillsTree' => $skillsTree,
	    									'profiles' => $profiles,
	    									'page' => $request->input('page','')]);
	}
	
	/**
	* profile adatok megjelenítése
	* @param Request $request  
	* @param int $id
	* @return void
	*/
	public function show(Request $request, int $id) {
	        $modelProfile = new Profiles();
	        $profile = $modelProfile->fullGet($id);
	        $request->session()->put('showProfile',$id);
	        $result = view('profileshow',["profile" => $profile]);
	    return $result;
	}
	
	/**
	* email küldő form megjelenítése (CSR tokent is kiir)
	* a sessionban a 'showProfile' tartalmazza a címzett user id -t
	* @param Request $request 
	*/
	public function emailForm(Request $request) {
		return 'email form';
	}
	
	/**
	* email elküldése CSR ellenörzéssel
	* a cimzett a sessionból 'showProfile'
	* csak bejelentkezett user küldhet levelet
	* @param Request $request 
	*/
	public function sendEmail(Request $request) {
		return 'email elküldése';	
	}
	
	
}
