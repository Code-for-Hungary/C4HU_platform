<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BugreportController extends Controller
{
	/**
	 * bugreport form  - sessionban van a taskInfo
	 * @param Request $request
	 * @return string
	 */
    public function form(Request $request) {
	    return view('bugreport',["taskInfo" => $request->session()->get('taskInfo') ]);
	}
	
	public function mailer($m) {
	    $m->to($this->email);
	    $m->subject(env('APP_NAME').' bugreport');
	}
	
	/**
	 * hibajelző email küldése
	 * @param Request $request "description", "taskinfo"
	 * @return string
	 */
	public function send(Request $request) {
	    $this->email = env('APP_EMAIL');
	    if ($request->input('_token') == $request->session()->token()) {
	        Try {
                \Mail::send('bugreport_mail',
    	                ["description" => $request->input("description"), "taskInfo" => $request->input('taskInfo')],
    	                function($m) {
    	                    $this->mailer($m);
                });
    	        return view('welcome',["msg" => __('bugreport.emailSent'), "msgClass" => "alert-success"]);
	        }
	        catch (exception $e) { 
	            return view('welcome',["msg" => $e->getMessage(), "msgClass" => "alert-danger"]);
	        }
	    } else {
	        echo 'Fatal error CSR token invalid'; exit();
	    }
	}
}
