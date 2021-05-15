@extends('layouts.app')
@section('content')
    <div class="loginForm" id="loginForm">
        <form method="POST" action="{{ route('login') }}" id="frmLogin">
            @csrf
            <div class="text-center">
                <a href="{{ url('/') }}/" aria-label="Space">
                    <img class="mb-3 logo-image" src="{{ url('/') }}/assets/img/logo.png" alt="Logo" width="60" height="60">
                </a>
            </div>
            <div class="text-center mb-4">
	        	<h2>{{ env('APP_NAME') }}</h2>
                <h1 class="h3 mb-0">{{ __('login.PleaseSignIn') }}</h1>
            </div>
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
    
            
            <div class="js-form-message mb-3">
                <div class="js-focus-state input-group form">
                <div class="input-group-prepend form__prepend">
                    <span class="input-group-text form__text">
                    <i class="fa fa-envelope form__text-inner"></i> E-mail
                    </span>
                </div>
                <input type="email" class="form-control form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email" autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
            </div>
        <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i> {{ __('login.Password') }}
                        </span>
                    </div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  
                    	placeholder="{{ __('login.Password') }}" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                  <!-- Checkbox -->
                  <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                    <input class="custom-control-input"type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">
                      {{ __('login.RememberMe') }}
                    </label>
                  </div>
                  <!-- End Checkbox -->
                </div>
            </div>
            
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary login-btn btn-block">{{ __('login.Signup') }}</button>
            </div>
            <div class="mb-12">
                <p class="text-muted">{{ __('login.NotSignin') }} <a href="{{route('register')}}">
                	{{ __('login.Regist') }}</a></p>
                <p class="text-muted">
                	<a href="#" onclick="jQuery('#frmLogin').attr('action','/forget-password'); jQuery('#frmLogin').submit(); false;"
                		style="cursor:pointer">
                		<i class="bx bx-chevron-right"></i>
                		{{ __('login.ForgetPassword') }}</a></p>
            </div>
            
            <div class="or-seperator"><i>{{ __('login.SocialLogin') }}</i></div>
            <div class="row mx-gutters-2 mb-4">
                <div class="mb-12">
                    <a href="{{ route('login.google') }}" class="btn btn-google">
                        	<em class="fa fa-google">&nbsp;</em>google
                    </a>
                    <a href="{{ route('login.facebook') }}" class="btn btn-facebook">
                        	<em class="fa fa-facebook">&nbsp;</em>facebook
                    </a>
                    <a href="{{ route('login.github') }}" class="btn btn-github">
                        	<em class="fa fa-github">&nbsp;</em>github
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

