@extends('layouts.app')
@section('content')
<div  id="profileProjects">

	    	@include('popup')
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
	            <div class="row">
	            	<h3><img class="avatar" src="{{ $user->avatar }}" /> {{ $user->name }}</h3>
	            	<h4>{{ __('contributor.projects') }}</h4>
						<table class="table table-bordered table-hover">
						    <thead>
						        <th></th>
						        <th>
						        	<a href="{{ url('/') }}/profileprojects/{{$user->id}}?page=1&orderfield=projects.name">
						        	{{ __('contributor.project_name') }}
						        	@if ($contributors->orderField == 'projects.name')
						        		@if ($contributors->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="{{ url('/') }}/profileprojects/{{$user->id}}?page=1&orderfield=contributors.status">
						        	{{ __('contributor.status') }}
						        	@if ($contributors->orderField == 'contributors.status')
						        		@if ($contributors->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="{{ url('/') }}/profileprojects/{{$user->id}}?page=1&orderfield=contributors.grade">
						        	{{ __('contributor.grade') }}
						        	@if ($contributors->orderField == 'contributors.grade')
						        		@if ($contributors->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						    </thead>
						    <tbody>
						        @if ($contributors->count() == 0)
						        <tr>
						            <td colspan="4">{{ __('contributor.notrecords') }}</td>
						        </tr>
						        @endif
						
						        @foreach ($contributors as $contributor)
						        <tr>
						            <td><img class="avatar" src="{{ $contributor->project_avatar }}" /></td>
						            <td><a href="{{ url('/') }}/project/{{ $contributor->project_id }}">
						            	{{ $contributor->project_name }}
						            	</a><br />
						            	{{ __('contributor.'.$contributor->project_status) }}
						            	</td>
						            <td>{{ __('contributor.'.$contributor->status) }}</td>
						            <td>{{ $contributor->grade }}</td>
						        </tr>
						        @endforeach
						    </tbody>
						</table>
						{{ $contributors->links() }}
						<p>
						    {{$contributors->count()}} / {{ $contributors->total() }} 
						</p>
	            </div>
	            <div class="buttons">
					<a class="ntm btn-primary" href="{{ url()->previous() }}">	            
		            	&nbsp;<em class="fa fa-undo"></em>
		            	{{ __('contributor.back') }}&nbsp;
		            </a>	
	            </div>
            </div>
</div>  
@endsection