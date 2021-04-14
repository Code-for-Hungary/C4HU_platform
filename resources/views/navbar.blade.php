<?php
	// Ha user'avatar nincs megadva akkor próbáljunk gravatar -t használni,
	if (Auth::user()) {
		if ((!isset(Auth::user()->avatar)) | (Auth::user()->avatar == '')) {
			Auth::user()->avatar = 'https://gravatar.com/avatar/'.md5(Auth::user()->email).
			'?default='.urlencode(URL::to('/').'/images/noavatar.png');
		}
	}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon fa  fa-bars"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  	<div style="display:inline-block; width:auto">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="{{ url('/') }}/"><em class="fa fa-home"></em> 
	        	{{ __('navbar.home') }} <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="{{ \URL::to('/projects') }}"> {{ __('navbar.projects') }} </a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="{{ \URL::to('/profiles') }}"> {{ __('navbar.volunters') }} </a>
	      </li>
	    </ul>
    </div>
  	<div style="display:inline-block; width:auto; float:right">
	    <ul class="navbar-nav mr-auto">
	      @auth
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      	   <img src="{{ Auth::user()->avatar }}" style="height:20px" />
		      	   {{ Auth::user()->name }} <em class="fa fa-caret-down"></em>	
	    	    </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown2" id="userMenu">
		           <div class="nav-subitem">	
		           	<a href="{{ \URL::to('/profileform') }}" class="text-sm text-gray-700 underline">
					<em class="fa fa-id-card"></em> {{ __('navbar.profile') }}</a>
				  </div>
 	              <div class="nav-subitem">	
		            <a href="#" onclick="jQuery('#logoutForm').submit()" class="text-sm text-gray-700 underline">
		            <em class="fa fa-sign-in-alt"></em> {{ __('navbar.logout') }} </a>
		          </div>  
		        </div>
		       </li> 
	      @else
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      	   {{ __('navbar.signin') }}<em class="fa fa-caret-down"></em>	
	    	    </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown3" id="userMenu">
 	               <div class="nav-subitem">	
		             <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">
		             <em class="fa fa-sign-in-alt"></em> {{ __('navbar.login') }}</a>
		           </div>
 	               <div class="nav-subitem">	
			           <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">
			           <em class="fa fa-key"></em> {{ __('navbar.regist') }}</a>
			       </div>    
		        </div>
		       </li> 
	      @endauth
		</ul>
	</div> 
	<div style="clear:both"></div>   
  </div>
  </div>
</nav>
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
