<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	@include('htmlhead')
    </head>
    <body class="antialiased">
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
	    	@include('navbar')
            <div class="pageBody construction text-center">
            	<p><img src="images/construction.png" style="height:200px" /></p>
            	<p>{{ __('underConstruction') }}</p>
            	<p><a class="btn btn-primary" href="{{ url()->previous() }}">Back</a></p>
            </div>
            @include('footer')
        </div>
    </body>
</html>
