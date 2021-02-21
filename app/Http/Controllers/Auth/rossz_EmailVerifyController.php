<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class EmailVerifyController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * emal verify form
    */ 
    public function form(Request $request)
    {
        echo 'email verify form '.JSON_encode($request).'<br>'.JSON_encode(\Auth::user()); exit();
        return '';
    }

    /**
    * emal send
    */ 
    public function send($request)
    {
        return 'email verify send '.JSON_encode($request);
    }
    

    /**
    * emal verify set user veridied
    */ 
    public function do($request)
    {
        return 'email verify do '.JSON_encode($request);
    }

}

?>
