<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	@include('htmlhead')
    </head>
    <body class="antialiased">
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
	    	@include('navbar')
	    	@include('popup');
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
	            <div class="row">
	                <div class= "col-sm-3">
	                	<h2>{{ __('profile.filter') }}</h2>
	                	<div id="skillsTree"></div>
	                </div>	
	                <div class= "col-sm-9" id="profilesTable">
	                	<h2>{{ __('profile.voluntarees') }}</h2>
						<table class="table table-bordered table-hover">
						    <thead>
						        <th></th>
						        <th>
						        	<a href="/profiles?page=1&orderfield=users.name">
						        	{{ __('profile.name') }}
						        	@if ($profiles->orderField == 'users.name')
						        		@if ($profiles->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="/profiles?page=1&orderfield=profiles.publicinfo">
						        	{{ __('profile.publicinfo') }}
						        	@if ($profiles->orderField == 'profiles.publicinfo')
						        		@if ($profiles->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="/profiles?page=1&orderfield=skills">
						        	{{ __('profile.skills') }}
						        	@if ($profiles->orderField == 'skills')
						        		@if ($profiles->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						    </thead>
						    <tbody>
						        @if ($profiles->count() == 0)
						        <tr>
						            <td colspan="4">{{ __('profile.notrecords') }}</td>
						        </tr>
						        @endif
						
						        @foreach ($profiles as $profile)
						        <tr>
						            <td><img class="avatar" src="{{ $profile->avatar }}" /></td>
						            <td><a href="/profileshow/{{ $profile->id }}?back={{ urlencode('/profiles?page='.$page) }}">
						            	{{ $profile->name }}
						            	</a>
						            	</td>
						            <td>{{ $profile->publicinfo }}</td>
						            <td>{{ $profile->skills }}</td>
						        </tr>
						        @endforeach
						    </tbody>
						</table>
						{{ $profiles->links() }}
						<p>
						    {{$profiles->count()}} / {{ $profiles->total() }} 
						</p>
	                </div>
	            </div>
            </div>
        </div>  
		<script src="js/tree.js"></script>
        <script type="text/javascript">
        $(function() {
        	// JQuery onload

			function decodeEntities(encodedString) {
			  var textArea = document.createElement('textarea');
			  textArea.innerHTML = encodedString;
			  return textArea.value;
			}

        	// skill fa megjelenitő init
        	var skillTree = new Tree('#skillsTree', {
                		data: {!! $skillsTree !!},
                		closeDepth:10,
                		values: JSON.parse(decodeEntities("{{ $profiles->filter }}")),
                		onChange: function() {
                			console.log(this.values);
                			if (this.doRedirect) {
                				let s = JSON.stringify(this.values);
                				s = encodeURI(s.replaceAll(/\"/g,''));
                				window.setTimeout('location="/profiles?page=1&filter='+s+'"',500);
                			}	
                		},	
                		loaded: function() {
                			this.doRedirect = true;
                		}	
                	});
                });	
         </script>              
    </body>
</html>
