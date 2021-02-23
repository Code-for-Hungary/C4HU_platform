<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	@include('htmlhead')
    </head>
    <body class="antialiased">
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
	    	@include('navbar')
            <div class="pageBody">
            <?php include $fname; ?>
            </div>
   			@include('footer')
        </div>
    </body>
</html>
