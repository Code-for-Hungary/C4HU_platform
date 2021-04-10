@extends('layouts.app')
@section('content')
<div>
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
		    	@include('popup');
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
                <div class="profileForm">
                	<form method="POST" action="{{ \URL::to('/contributor') }}" id="frmContributor">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $contributor->project_id }}" />
                        <input type="hidden" name="user_id" value="{{ $contributor->user_id }}" />
		            	<h3>
	                    <img class="avatar" src="{{ $contributor->project_avatar }}" />
	                    {{ $contributor->project_name }}</h3>
	                    <p>{{ __('contributor.status') }}: 
	                    {{ __('contributor.'.$contributor->project_status) }}
	                    {{ __('contributor.deadline') }}: 
	                    {{ $contributor->project_deadline }}</p>
						<h4>{{ __('contributor.contributor') }}</h4>						
						<p>
	                    <img class="avatar" src="{{ $contributor->user_avatar }}" />
	                    {{ $contributor->user_name }} 
	                    </p>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('contributor.status') }}
                                    </span>
                                </div>
                                <select name="status" id="status" class="form-control">
                                	<option value="appliciant">{{ __('contributor.appliciant') }}</option>
                                	<option value="active">{{ __('contributor.active') }}</option>
                                	<option value="inactive">{{ __('contributor.inactive') }}</option>
                                	<option value="exited">{{ __('contributor.exited') }}</option>
                                </select> 
                            </div>
                        </div>

	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('contributor.description') }}
                                    </span>
                                </div>
                                <textarea cols="80" rows="5" class="form-control" name="description">{{ $contributor->description }}</textarea>  
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('contributor.evaluation') }}
                                    </span>
                                </div>
                                <textarea cols="80" rows="5" class="form-control" name="evaluation">{{ $contributor->evaluation }}</textarea>  
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('contributor.grade') }}
                                    </span>
                                </div>
                                <input type="number" min="1" max="5" class="form-control" 
                                name="grade" value="{{ $contributor->grade }}" />  
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('contributor.start') }}
                                    </span>
                                </div>
                                <input type="date" class="form-control" 
                                name="start" value="{{ $contributor->start }}" />  
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('contributor.end') }}
                                    </span>
                                </div>
                                <input type="date" class="form-control" 
                                name="start" value="{{ $contributor->end }}" />  
                            </div>
                        </div>
	                    
	                    
	                    <div class="form-group">
	                    	<button type="submit" class="btn btn-primary" id="btnSave">
	                    		{{ __('contributor.save') }}
	                    	</button>
						</div>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
            	$(function() {
					$('#status').val("{{ $contributor->status }}");            	
            	});
            </script>
 </div>
@endsection