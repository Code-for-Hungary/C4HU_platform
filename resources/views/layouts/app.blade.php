<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   	@include('htmlhead')
</head>
<body>
    <div id="app">
    	@include('navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
