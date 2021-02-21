<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	@include('htmlhead')
    </head>
    <body class="antialiased">
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
			<div class="emailverifyNav text-left">
					<a href="{{ URL::to('/') }}">
						<em class="fa fa-home"></em> {{ __('emailverify.home') }}
					</a>		
			</div>
        	<div class="pageBody emailVerify">
		        <div class="text-center">
		        	<h2>{{ env('APP_NAME') }}</h2>
					<img src="/images/logo.png" class="logo" />
					<h2>{{ __('emailverify.title') }}</h2>
					<h3>{{ $email }}</h3>
					<p class"buttons">
						<a href="{{ URL::to('/sendemailverify') }}/{{ urlencode($email) }}" class="btn btn-primary"> {{ __('emailverify.send') }}</a>
					</p>
					<p class="help">
						{{ __('emailverify.help') }}
					</p>	        
		        </div>
	        </div>
			@include('footer')
        </div>
    </body>
</html>
