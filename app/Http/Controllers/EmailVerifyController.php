<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmailVerifyController extends Controller
{
	protected $email = '';
	
	/**
	* email aktiváló levél küldés form, bejelentkezett usert kijelentkezteti
	* a "send" gomra kattintás a "send" funkciót fogja aktiválni
	* @param Request $request
	* @return string full HTML page
	*/	
	public function form(Request $request) {
		$result = '';
		$user = \Auth::user();
		if (!$user) {
			$result = redirect(\URL::to('/'));		
		} else {
			$email = $user->email;
			\Auth::guard()->logout();
			$request->session()->invalidate();
			$request->session()->regenerateToken();
			if ($user) {
				$result = view('emailverify',["email" => $email]);
			} else {
				$result = redirect(\URL::to('/'));		
			}
		}
		return $result;	
	}
	
	public function mailer($m) {
		$m->to($this->email);
		$m->subject(__('emailverify.mailSubject'));
	}

	/**
	* aktiváló email elküldése, urlben paraméter: email
	* - token -t generál és tárol a users táblába
	* - levelet küld
	* - redirekt a kezdőlapra
	* @param Request $request
	* @param string $email
	* @return string full HTML page
	*/
	public function send(Request $request, $email) {
		$this->email = $email;
		// user_id beolvasása az adatbázisból
		$users = DB::select('select * from users where email = ?', [$email]);
		if (count($users) == 1) {
			$user_id = $users[0]->id;		
		} else {
			$user_id = 0;
			return view('welcome',["msg" => $email." email not unique or not found", "msgClass" => "alert-danger" ]);	
		}			
		// token generálás és tárolás az adatbázisba
		$token = \Str::random(32).'-'.$user_id;
		$affected = DB::update(
  		  'update users set remember_token = ? where email = ?',
   			 [$token, $email]
		);
		if ($affected == 1) {
			// levél küldés
			\Mail::send('emailverify_mailbody',
				["url" => \URL::to('/doemailverify').'/'.$token],
				function($m) { 
					$this->mailer($m); 
				});
			return view('welcome',["msg" => __('emailverify.emailSended'), "msgClass" => "alert-info" ]);	
		} else {
			return view('welcome',["msg" => $email." email not unique or not found", "msgClass" => "alert-danger" ]);	
		}
	}

	/**
	* aktiváló linkben lévő link feldolgozása, url param: token
	* - users tábla modosítása
	* - redirect /login -ra
	* @param Request $request
	* @param string $token
	* @return string full HTML page
	*/
	public function do(Request $request, $token) {
		$affected = DB::update(
  		  'update users set email_verified_at = ?, remember_token = ""
  		   where remember_token = ?',
   			 [date('Y-m-d H:i:s'), $token]
		);
		if ($affected == 1) {
			return view('welcome',["msg" => __('emailverify.successActivated'), "msgClass" => "alert-success" ]);
		} else {
			return view('welcome',["msg" => "invalid token", "msgClass" => "alert-danger" ]);	
		}		
	}

}
