@extends('layouts.app')
@section('content')
<div id="emailverifyForm">
	<div class="emailverifyNav text-left">
			<a href="{{ URL::to('/') }}">
				<em class="fa fa-home"></em> {{ __('emailverify.home') }}
			</a>		
	</div>
	<div class="pageBody emailVerify">
        <div class="text-center">
			<h2>{{ __('emailverify.title') }}</h2>
			<h3>{{ $email }}</h3>
			<p class"buttons">
				<a href="{{ URL::to('/sendemailverify') }}/{{ urlencode($email) }}" class="btn btn-primary"> {{ __('emailverify.send') }}</a>
			</p>
			<p class="help">
				{{ __('emailverify.help') }}
			</p>	        
        </div>
    </div>
</div>
@endsection