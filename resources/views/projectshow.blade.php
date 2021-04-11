@extends('layouts.app')
@section('content')
<div>
	    	@include('popup');
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
           		<h2>{{ env('APP_NAME') }}</h2>	
            	<img src="{{ url('/') }}/images/logo.png" class="logo" />
				@if (count($errors) > 0)
				   <div class = "alert alert-danger">
				      <ul>
				         @foreach ($errors->all() as $error)
				            <li>{{ __('project.'.$error) }}</li>
				         @endforeach
				      </ul>
				   </div>
				@endif            
            	<ul class="nav nav-tabs">
					<li class="active">
						<a href="#">{{ __('project.info') }}</a>
					</li>
  					<li>
  						<a href="{{ \URL::to('/contributors/'.$project->id) }}">{{ __('project.contributors') }}</a>
  					</li>
				</ul>
                <div class="projectShow">
                	<form method="POST" action="{{ \URL::to('/project') }}" id="frmProject">
		            	<h3>{{ __('project.project') }}</h3>
	                    <div class="form-group">
                            <img class="avatar" src="{{ $project->avatar }}" />&nbsp;
                            <label>{{ __('project.name') }}</label>:&nbsp;
                            {{ $project->name }}
                        </div>
	                    <div class="form-group">
	                    	<label>{{ __('project.ownerUser') }}</label>:&nbsp;
	                    	<img class="avatar" src="{{ $project->user_avatar }}" />&nbsp; 
	                    	{{ $project->user_name }}
						</div>                        
	                    <div class="form-group">
                            <div class="input-group">
                                <label>{{ __('project.organisation') }}</label>:&nbsp;
                                {{ $project->organisation }}
                            </div>
                        </div>
	                    <div class="form-group">
                                <label>{{ __('project.website') }}</label>:&nbsp;
                                <a href="$project->website" target="_new">{{ $project->website }}</a>
                        </div>
	                    <div class="form-group">
                                <label>{{ __('project.deadline') }}</label>:&nbsp;
                                {{ $project->deadline }}
                        </div>
	                    <div class="form-group">
                                <label>{{ __('project.status') }}</label>:&nbsp;
                                {{ $project->status }}
                        </div>

	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label>{{ __('project.description') }}</label>
                                    </span>
                                </div>
                                <textarea readonly="readonly" cols="80" rows="10" class="form-control" name="description">{{ $project->description }}</textarea>  
                            </div>
                        </div>

                        <div class="skillsBlock">
                            <h3>{{ __('project.skills') }}</h3>
							@foreach ($project->skills as $skill )                        
                        		{{ $skill->name }}
                        	@endforeach
                        	<br /><br />
                        </div>	
	                    <div class="form-group">
	                    	@if (\Auth::user())
	                    	<a class="btn btn-secondary" href="{{ url('/') }}/contributoradd/{{ $project->id }}">
	                    		<em class="fa fa-hand-paper"></em>
	                    		{{ __('project.aspirant') }}
	                    	</a>
	                    	<a class="btn btn-secondary" href="{{ url('/') }}/email">
	                    		<em class="fa fa-envelope"></em>
	                    		{{ __('project.sendEmail') }}
	                    	</a>
	                    	@endif
	                    	<a class="btn btn-primary" href="{{ url()->previous() }}">
	                    		<em class="fa fa-undo"></em>
	                    		{{ __('project.back') }}
	                    	</a>
						</div>
                    </form>
                </div>
            </div>
</div>
@endsection
