<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	@include('htmlhead')
    </head>
    <body class="antialiased">
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
	    	@include('navbar')
            <div class="pageBody sysadmins">
				<h2>{{ __('profile.sysadmins') }}</h2>
				<table class="table table-stripped">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>{{ __('profile.name') }}</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($items as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td>{{ $item->name }}</td>
							<td>
							@if ($item->id != \Auth::user()->id)
							<a class="btn btn-danger" 
								href="{{ \URL::to('/profilesetsysadmin/'.$item->id.'/del') }}">
								{{ __('profile.unset') }}
							</a>
							@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<h3>{{ __('profile.addNewSysadmin') }}</h3>
				<form method="get" action="{{ \URL::to('/profilesetsysadmin/a/add') }}">
					<label>{{ __('profile.email') }}</label>
					<input type="text" name="value" />
					<button type="submit" class="btn btn-primary">
						{{ __('ok') }}
					</button>
				</form>
            </div>
   			@include('footer')
        </div>
    </body>
</html>
