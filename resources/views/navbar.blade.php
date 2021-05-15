<?php
	// Ha user'avatar nincs megadva akkor próbáljunk gravatar -t használni,
	if (Auth::user()) {
		if ((!isset(Auth::user()->avatar)) | (Auth::user()->avatar == '')) {
			Auth::user()->avatar = 'https://gravatar.com/avatar/'.md5(Auth::user()->email).
			'?default='.urlencode(URL::to('/').'/assets/img/noavatar.png');
		}
	}
?>

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="me-auto">
      	<a href="{{ url('/') }} "><img class="avatar" src="{{ url('/') }}/assets/img/logo.png" />
			{{ env('APP_NAME') }}      	
      	</a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{ url('/') }}">{{ __('navbar.home') }}</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/projects') }}">{{ __('navbar.projects') }}</a></li>
          <li><a class="nav-link scrollto" href="{{ url('/profiles') }}">{{ __('navbar.volunters') }}</a></li>
	      @auth
		      <li class="dropdown">
		        <a href="#" id="navbarDropdown2">
		      	   <img src="{{ Auth::user()->avatar }}" style="height:20px" />
		      	   {{ Auth::user()->name }} <em class="fa fa-caret-down"></em>	
	    	    </a>
		        <ul>
		           <li>	
		           	<a href="{{ \URL::to('/profileform') }}">
					{{ __('navbar.profile') }}</a>
				  </li>
 	              <li>	
		            <a href="#" onclick="jQuery('#logoutForm').submit()">
		            {{ __('navbar.logout') }} </a>
		          </li>  
		        </ul>
		       </li> 
	      @else
		      <li class="dropdown">
		        <a href="#" id="navbarDropdown3">
		      	   {{ __('navbar.signin') }}<em class="fa fa-caret-down"></em>	
	    	    </a>
		        <ul>
 	               <li>	
		             <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">
		             {{ __('navbar.login') }}</a>
		           </li>
 	               <li>	
			           <a href="{{ route('register') }}" class="text-sm text-gray-700 underline">
			           {{ __('navbar.regist') }}</a>
			       </li>    
		        </ul>
		       </li> 
	      @endauth
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

@if (isset($msg))
	<div class="alert {{ $msgClass ?? '' }}"> 
    	{{ $msg ?? '' }}
	</div>	
@endif
<div style="display:none">
	<form id="logoutForm" method="post" action="{{ url('/') }}/logout">
		@csrf
	</form>
</div>
