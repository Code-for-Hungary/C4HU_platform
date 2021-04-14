@extends('layouts.app')
@section('content')
<div>
aaaaaaaaaaaaaaaaaaa
	    	@include('popup');
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
           		<h2>{{ env('APP_NAME') }}</h2>	
            	<img src="/images/logo.png" class="logo" />
				@if (count($errors) > 0)
				   <div class = "alert alert-danger">
				      <ul>
				         @foreach ($errors->all() as $error)
				            <li>{{ __('contributor.'.$error) }}</li>
				         @endforeach
				      </ul>
				   </div>
				@endif        
                <div class="contributorShow">
                	<form method="POST" action="{{ \URL::to('/contributor') }}" id="frmContributor">
		            	<h3>{{ __('contributor.project') }}</h3>
	                    <div class="form-group">
                            <img class="avatar" src="{{ $contributor->project_avatar }}" />&nbsp;
                            {{ $contributor->project_name }}
                        </div>
	                    <div class="form-group">
                                <label>{{ __('contributor.status') }}</label>:&nbsp;
                                {{ __('contributor.'.$contributor->project_status) }}
                        </div>
                        <h4>{{ __('contributor.contributor') }}</h4>
	                    <div class="form-group">
	                    	<img class="avatar" src="{{ $contributor->user_avatar }}" />&nbsp; 
	                    	{{ $contributor->user_name }}&nbsp;{{ __('contributor.'.$contributor->status) }}
						</div>                        
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label>{{ __('contributor.description') }}</label>
                                    </span>
                                </div>
                                <textarea readonly="readonly" cols="80" rows="5" class="form-control" name="description">{{ $contributor->description }}</textarea>  
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label>{{ __('contributor.evaluation') }}</label>
                                    </span>
                                </div>
                                <textarea readonly="readonly" cols="80" rows="5" class="form-control" name="description">{{ $contributor->evaluation }}</textarea>  
                            </div>
                        </div>
	                    <div class="form-group">
	                    	<label>{{ __('contributor.grade') }}</label>:&nbsp;
	                    	{{ $contributor->grade }}
						</div>                        
	                    <div class="form-group">
	                    	<label>{{ __('contributor.start') }}</label>:&nbsp;
	                    	{{ $contributor->start }}
						</div>                        
	                    <div class="form-group">
	                    	<label>{{ __('contributor.end') }}</label>:&nbsp;
	                    	{{ $contributor->end }}
						</div>                        
	                    <div class="form-group">
	                    	<a class="btn btn-primary" href="{{ url()->previous() }}">
	                    		<em class="fa fa-undo"></em>
	                    		{{ __('contributor.back') }}
	                    	</a>
						</div>
                    </form>
                </div>
            </div>
</div>
@endsection

