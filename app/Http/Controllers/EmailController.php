<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmailController extends Controller {
	
	/**
	* email küldő form. csak bejelentkezett user használhatja
	* @param Request $request  sessionban emailTo
	*/
	public function form(Request $request) {
		$user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('email.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	    	$to = User::where('id','=', $request->session()->get('emailTo',''))->first();
	    	if ($to) {
				$toName = $to->name;	    	
	    	} else {
		        $result = view('welcome',["msg" => __('email.notfound'), "msgClass" => "alert-danger"]);
	    	}
	    	$result = view('emailform',['toName' => $toName]);
	   	}
	   	return $result;
	}
	
	public function mailer($m) {
		$m->to($this->email);
		$m->subject($this->subject);
	}
	
	/**
	* email elküldése
	* @param Request $request subject, body, sessionban emailTo
	*/
	public function send(Request $request) {
		$user = \Auth::user();
	    if (!$user) {
	        $result = view('welcome',["msg" => __('email.notlogged'), "msgClass" => "alert-danger"]);
	    } else {
	    	$to = User::where('id','=', $request->session()->get('emailTo',''))->first();
	    	if ($to) {
	    		$this->email = $to->email;
				$this->subject = $request->input('subject'); 	
				\Mail::send('emailmsg',
					['body' => $request->body,
					'fromName' => $user->name,
					'fromEmail' => $user->email],
					function($m) { 
						$this->mailer($m); 
					});
			}
		}	
		
		// vissza a második eloző oldalra
		echo '<script type="text/javascript">'
  		   , 'history.go(-2);'
  		   , '</script>';
		
	}
}
