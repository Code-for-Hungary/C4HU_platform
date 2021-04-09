@extends('layouts.app')
@section('content')
<div class="bugreport">
    <form method="POST" action="{{ \URL::to('/bugreportsend') }}" id="frmBugreport">
    	<h2>{{ env('APP_NAME') }}</h2>
    	<img src="/images/logo.png" class="logo" />
    	<h3>{{ __('bugreport.reportForm') }}</h3>
        @csrf
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        {{ __('bugreport.description') }}
                    </span>
                </div>
                <textarea cols="80" rows="10" class="form-control" name="description"></textarea>  
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        {{ __('bugreport.taskInfo') }}
                    </span>
                </div>
                <textarea cols="80" rows="10" class="form-control" name="taskInfo">
                	{{ JSON_encode($taskInfo,JSON_PRETTY_PRINT) }}
                </textarea>  
                <br />{{ __('bugreport.help') }}
            </div>
        </div>
        <div class="form-group">
        	<button type="submit" class="btn btn-primary">{{ __('bugreport.send') }}</button>
		</div>
    </form>
</div>
@endsection				