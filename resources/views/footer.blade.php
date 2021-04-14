<div class="footer">
	<div class="row">
		<div class="col-sm-6">
			<strong><em class="fa fa-lock"></em> GDPR</strong><br />
			<a href="{{ \URL::to('/textpage/policy1') }}">
				{{ __('footer.policy1') }}
			</a><br />
			<a href="{{ \URL::to('/textpage/policy2') }}">
				{{ __('footer.policy2') }}
			</a><br />
			<a href="{{ \URL::to('/textpage/policy3') }}">
				{{ __('footer.policy3') }}
			</a>
		</div>
		<div class="col-sm-6">
			<a href="{{ \URL::to('/textpage/impressum') }}">
				<em class="fa fa-info-circle"></em> {{ __('footer.impressum') }}
			</a><br />
			<a href="https://opensource.org/licenses/MIT" target="_new">
				<em class="fa fa-copyright"></em> {{ __('footer.licence') }}
			</a><br />
			<a href="https://github.com/Code-for-Hungary/fogadj-orokbe-egy-web-oldalt" target="_new">
				<em class="fa fa-code"></em> {{ __('footer.source') }}
			</a><br />
			<a href="{{ \URL::to('/bugreportform') }}">
				<em class="fa fa-bug"></em> {{ __('footer.bugreport') }}
			</a><br />
		
		</div>
	</div>
</div>
@include('cookieConsent::index')
<div><pre>
<?php 
// task info tárolása a sessionba a hibajelentéshez
request()->session()->forget('taskInfo');
$taskInfo = new \stdClass();
$taskInfo->REQUEST_URI = $_SERVER['REQUEST_URI'];
$taskInfo->REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$taskInfo->HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
$taskInfo->REQUESTS = request()->all();
$taskInfo->SESSIONS = request()->session()->all();
$taskInfo->USER = \Auth::user();
request()->session()->put('taskInfo',$taskInfo);
?>
</pre></div>