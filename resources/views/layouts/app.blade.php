<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   	@include('htmlhead')
</head>
<body>
    <div id="app">
    	@include('navbar')
        <main class="pageBody py-4">
            @yield('content')
        </main>
		@include('footer')
    </div>
</body>
</html>
