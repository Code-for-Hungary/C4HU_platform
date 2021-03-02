<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$result = view('welcome');	
    	if (\Auth::user()) {
    		$user = \Auth::user();
    		if ((!isset($user->email_verified_at)) | ($user->email_verified_at <= '1900-01-01 00:00:00')) {    			
    			$result = redirect('/emailverifyform');		
    		}
    	}	 
        return $result;
    }
}
