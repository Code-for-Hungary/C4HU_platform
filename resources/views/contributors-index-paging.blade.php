@extends('layouts.app')
@section('content')
<div id="contributorsForm">

	    	@include('popup')
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
	            <div class="row">
	            	<h3>{{ $project->name }} ( {{ __('contributor.'.$project->status) }} )</h3>
	            	<h4>{{ __('contributor.contributors') }}</h4>
						<table class="table table-bordered table-hover">
						    <thead>
						        <th></th>
						        <th>
						        	<a href="{{ url('/') }}/contributors/{{ $project->id }}?page=1&orderfield=user_name">
						        	{{ __('contributor.name') }}
						        	@if ($contributors->orderField == 'user_name')
						        		@if ($contributors->orderDir == 'ASC')
						        			<em class="fa fa-caret-down"></em>
						        		@else
						        			<em class="fa fa-caret-up"></em>
						        		@endif
						        	@endif
						        	</a>
						        </th>
						        <th>
						        	<a href="{{ url('/') }}/contributors/{{ $project->id }}?page=1&orderfield=contributors.status">
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
						        	<a href="{{ url('/') }}/contributors/{{ $project->id }}?page=1&orderfield=contributors.grade">
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
						            <td><img class="avatar" src="{{ $contributor->user_avatar }}" /></td>
						            <td><a href="{{ url('/') }}/contributor/{{ $contributor->project_id }}/{{ $contributor->user_id }}">
						            	{{ $contributor->user_name }}
						            	</a>
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