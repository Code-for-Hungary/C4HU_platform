@extends('layouts.app')
@section('content')
<div id="profileshowForm">
	    	@include('popup')
	    	<div id="profileTop">&nbsp;</div>
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
				@if (count($errors) > 0)
				   <div class = "alert alert-danger">
				      <ul>
				         @foreach ($errors->all() as $error)
				            <li>{{ __('profile.'.$error) }}</li>
				         @endforeach
				      </ul>
				   </div>
				@endif            
            	<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" href="#">{{ __('profile.info') }}</a>
					</li>
  					<li class="nav-item">
  						<a class="nav-link" href="{{ \URL::to('/profileprojects/'.$profile->id) }}">{{ __('profile.linkedProjects') }}</a>
  					</li>
				</ul>
                <div class="profileForm">
                	<form class="form">
		            	<h3>{{ __('profile.profile') }}</h3>
	                    <div class="form-group">
	                    	{{ $profile->name }}
	                    	<img class="bigAvatar" src="{{ $profile->avatar }}" style="float:right" />
						</div>		            	
	                    <div class="form-group">
	                    	@if ($profile->sysadmin == 1)
	                    	<strong></strong>{{ __('profile.sysadmin') }}</strong>
	                    	@endif
						</div>		            	

	                    <div class="form-group">
                                    <label>
                                        {{ __('profile.voluntary') }}
                                    </label>
	                                @if ($profile->voluntary == 1) 
    	                            <input type="checkbox" disabled="disabled" name="voluntary" checked="checked" value="1"/>
        	                        @else
            	                    <input type="checkbox" disabled="disabled" name="voluntary" value="1" />
                	                @endif
                        </div>
	                    <div class="form-group">
                                    <label>
                                        {{ __('profile.project_owner') }}
                                    </label>
	                                @if ($profile->project_owner == 1)
    	                            <input type="checkbox" disabled="disabled" name="project_owner" checked="checked" value="1"  />
        	                        @else
            	                    <input type="checkbox" disabled="disabled" name="project_owner" value="1" />
                	                @endif
                        </div>
	                    <div class="form-group">
                                <label>
                                        {{ __('profile.publicinfo') }}
                                </label>
                                <textarea readonly="readonly" cols="80" rows="10" class="form-control" name="publicinfo">{{ $profile->publicinfo }}</textarea>  
                        </div>
                        <div class="skillsBlock">
                        	<h3> {{ __('profile.skills') }}</h3>
                        	@foreach ($profile->skills as $skill)
                        		<p>{{ $skill->name }} {{ $skill->level }}</p>
                        	@endforeach
		                </div>
	                    <div class="form-group">
							<a href="{{ url('/') }}/email" class="btn bt-secondary">
								<em class="fa fa-envelope"></em>
								{{ __('profile.sendEmail') }}
							</a>
	                    	<a class="btn btn-primary" id="btnBack"
	                    		href="{{ url()->previous() }}">
	                    		<em class="fa fa-undo"></em>
	                    		{{ __('profile.back') }}
	                    	</a>
						</div>
                    </form>
                    <p>Saját adataidat a "profil" menüpontban módosíthatod.</p>
                </div>
            </div>
</div>
@endsection
