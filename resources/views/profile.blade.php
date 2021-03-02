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
                <div class="profileForm">
                    <form method="POST" action="{{ \URL::to('/profilesave') }}" id="frmProfile">
		            	<h2>{{ env('APP_NAME') }}</h2>
        		    	<img src="/images/logo.png" class="logo" />
		            	<h3>{{ __('profile.profile') }}</h3>
	                    <div class="form-group">
	                    	{{ \Auth::user()->name }}
						</div>		            	
	                    <div class="form-group">
	                    	@if ($sysadmin == 1)
	                    	<strong></strong>{{ __('profile.sysadmin') }}</strong>
	                    	@endif
						</div>		            	
                        @csrf
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('profile.avatar') }}
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="avatar" 
                                size="80" value="{{ \Auth::user()->avatar }}" />
                                <br />{{ __('profile.avatarhelp') }}
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('profile.voluntary') }}
                                    </span>
	                                @if ($voluntary == 1) 
    	                            <input type="checkbox" name="voluntary" checked="checked" value="1"/>
        	                        @else
            	                    <input type="checkbox" name="voluntary" value="1" />
                	                @endif
                                </div>
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('profile.web_site_owner') }}
                                    </span>
	                                @if ($web_site_owner == 1)
    	                            <input type="checkbox" name="web_site_owner" checked="checked" value="1"  />
        	                        @else
            	                    <input type="checkbox" name="web_site_owner" value="1" />
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
                                <textarea cols="80" rows="10" class="form-control" name="publicinfo">{{ $publicinfo }}</textarea>  
                            </div>
                        </div>
	                    <div class="form-group">
	                    	<button type="submit" class="btn btn-primary">{{ __('profile.save') }}</button>
						</div>
	                    <div class="form-group">
	                    	<button  type="button" class="btn btn-danger" 
	                    		onclick="$('#popup').show(); " }}>
	                    		{{ __('profile.delete') }}</button>
	                    	@if ($sysadmin == 1)
	                    	<a class="btn btn-secondary" href="{{ \URL::to('profilesysadmins') }}">
	                    		{{ __('profile.sysadmins') }}</a>
	                    	@else
	                    	<a  class="btn btn-danger" href="{{ \URL::to('profiledel') }}">
	                    		{{ __('profile.delete') }}</a>
	                    	@endif
						</div>
	                    <div class="form-group">
	                    	{{ __('profile.help') }}
						</div>						
                    </form>
                </div>
            </div>
   			@include('footer')
        </div>
    </body>
</html>
