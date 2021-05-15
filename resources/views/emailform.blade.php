@extends('layouts.app')
@section('content')
<div id="emailForm">
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="emailForm">
                	<h2>{{ __('email.sendEmail') }}</h2>
                	<form method="POST" action="{{ \URL::to('/email') }}" id="frmEmail">
		            	<h3>{{ __('project.project') }}</h3>
		            	<p>{{ __('email.to') }}: {{ $toName }}</p>
		            	<p>{{ __('email.from') }}: {{ \Auth::user()->name }}</p>
                        @csrf
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('email.subject') }}
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="subject" 
                                size="80" value="" />
                            </div>
                        </div>
	                    <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ __('email.body') }}
                                    </span>
                                </div>
                                <textarea cols="80" rows="10" class="form-control" name="body"></textarea>  
                            </div>
                        </div>

	                    <div class="form-group">
	                    	<button class="btn btn-primary" id="btnSave">
	                    		<em class="fa fa-check"></em>{{ __('email.send') }}
	                    	</button>
	                    	<a class="btn btn-secondary") href="{{ url()->previous() }}">
	                    		<em class="fa fa-undo"></em>
	                    		{{ __('email.back') }}
	                    	</a>
						</div>
                    </form>
                </div>
        </div>
</div>
@endsection
