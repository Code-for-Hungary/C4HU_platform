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
           		<h2>{{ env('APP_NAME') }}</h2>	
            	<img src="/images/logo.png" class="logo" />
	            <div class="row">
	                <div class= "col-sm-3">
	                	<h2>{{ __('project.filter') }}</h2>
	                	<div id="skillsTree"></div>
	                </div>	
	                <div class= "col-sm-9" id="projectsTable">
	                	<h2>{{ __('project.projects') }}</h2>
						<table class="table table-bordered table-hover">
						    <thead>
						        <th></th>
						        <th>
						        	<a href="/projects?page=1&orderfield=projects.name">
						        	{{ __('project.name') }}
						        	@if ($projects->orderField == 'projects.name')
						        		@if ($projects->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="/projects?page=1&orderfield=projects.status">
						        	{{ __('project.status') }}
						        	@if ($projects->orderField == 'projects.status')
						        		@if ($projects->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="/projects?page=1&orderfield=projects.deadline">
						        	{{ __('project.deadline') }}
						        	@if ($projects->orderField == 'projects.deadline')
						        		@if ($projects->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="/projects?page=1&orderfield=skills">
						        	{{ __('project.skills') }}
						        	@if ($projects->orderField == 'skills')
						        		@if ($projects->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        
						    </thead>
						    <tbody>
						        @if ($projects->count() == 0)
						        <tr>
						            <td colspan="5">{{ __('project.notrecords') }}</td>
						        </tr>
						        @endif
						
						        @foreach ($projects as $project)
						        <tr>
						            <td><img class="avatar" src="{{ $project->avatar }}" /></td>
						            <td><a href="/projecthow/{{ $project->id }}">
						            	{{ $project->name }}
						            	</a>
						            	@if ($project->website != '') 
						            	<br />
						            	<a href="{{ $project->website 	}}" target="_new">web site</a>
						            	@endif
						            </td>
						            <td>{{ __('project.'.$project->status) }}</td>
						            <td>{{ $project->deadline }}</td>
						            <td>{{ $project->skills }}</td>
						        </tr>
						        @endforeach
						    </tbody>
						</table>
						{{ $projects->links() }}
						<p>
						    {{$projects->count()}} / {{ $projects->total() }} 
						</p>
						<p class="buttons">
							<a class="btn btn-primary" href="/project/0">
								<em class="fa fa-plus-square"></em>
								{{ __('project.add') }}
							</a>						
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
                		values: JSON.parse(decodeEntities("{{ $projects->filter }}")),
                		onChange: function() {
                			console.log(this.values);
                			if (this.doRedirect) {
                				let s = JSON.stringify(this.values);
                				s = encodeURI(s.replaceAll(/\"/g,''));
                				window.setTimeout('location="/projects?page=1&filter='+s+'"',500);
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
