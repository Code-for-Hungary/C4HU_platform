<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   	@include('htmlhead')
</head>
<body>
    <div id="app">
    	<div> 
    		@include('navbar') 
    	</div>
    	<div>
        	<main class="pageBody py-4">
            	@yield('content')
        	</main>
        </div>
        <div>
			@include('footer')
		</div>	
    </div>
</body>
</html>
