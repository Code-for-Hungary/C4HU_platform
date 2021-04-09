@extends('layouts.app')
@section('content')
<div>
	    	@include('popup');
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
           		<h2>{{ env('APP_NAME') }}</h2>	
            	<img src="/images/logo.png" class="logo" />
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
					<li class="active">
						<a href="#">{{ __('profile.info') }}</a>
					</li>
  					<li>
  						<a href="{{ \URL::to('/profileprojects/'.$profile->id) }}">{{ __('profile.linkedProjects') }}</a>
  					</li>
				</ul>
                <div class="profileForm">
                	<form class="form">
		            	<h2>{{ env('APP_NAME') }}</h2>
        		    	<img src="/images/logo.png" class="logo" />
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
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('profile.voluntary') }}
                                    </span>
	                                @if ($profile->voluntary == 1) 
    	                            <input type="checkbox" disabled="disabled" name="voluntary" checked="checked" value="1"/>
        	                        @else
            	                    <input type="checkbox" disabled="disabled" name="voluntary" value="1" />
                	                @endif
                                </div>
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('profile.project_owner') }}
                                    </span>
	                                @if ($profile->project_owner == 1)
    	                            <input type="checkbox" disabled="disabled" name="project_owner" checked="checked" value="1"  />
        	                        @else
            	                    <input type="checkbox" disabled="disabled" name="project_owner" value="1" />
                	                @endif
                                </div>
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('profile.publicinfo') }}
                                    </span>
                                </div>
                                <textarea readonly="readonly" cols="80" rows="10" class="form-control" name="publicinfo">{{ $profile->publicinfo }}</textarea>  
                            </div>
                        </div>
                        <div class="skillsBlock">
                        	<h3> {{ __('profile.skills') }}</h3>
                        	@foreach ($profile->skills as $skill)
                        		<p>{{ $skill->name }} {{ $skill->level }}</p>
                        	@endforeach
		                </div>
	                    <div class="form-group">
							<a href="/email" class="btn bt-secondary">
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
