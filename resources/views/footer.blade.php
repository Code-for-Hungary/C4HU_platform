 <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row footer-info">

				<div class="col-sm-6  footer-links">
					<strong><em class="fa fa-lock"></em> GDPR</strong><br />
					<ul>
					<li><i class="bx bx-chevron-right"></i>
						<a href="{{ \URL::to('/textpage/policy1') }}">
						{{ __('footer.policy1') }}
						</a></li>
					<li><i class="bx bx-chevron-right"></i>
						<a href="{{ \URL::to('/textpage/policy2') }}">
						{{ __('footer.policy2') }}
						</a></li>
					<li><i class="bx bx-chevron-right"></i>
						<a href="{{ \URL::to('/textpage/policy3') }}">
						{{ __('footer.policy3') }}
						</a></li>
					</ul>
				</div>
				<div class="col-sm-6  footer-links">
					<ul>
					<li><i class="bx bx-chevron-right"></i>
						<a href="{{ \URL::to('/textpage/impressum') }}">
						<em class="fa fa-info-circle"></em> {{ __('footer.impressum') }}
						</a></li>
					<li><i class="bx bx-chevron-right"></i>
						<a href="https://opensource.org/licenses/MIT" target="_new">
						<em class="fa fa-copyright"></em> {{ __('footer.licence') }}
						</a></li>
					<li><i class="bx bx-chevron-right"></i>
						<a href="https://github.com/Code-for-Hungary/fogadj-orokbe-egy-web-oldalt" target="_new">
						<em class="fa fa-code"></em> {{ __('footer.source') }}
						</a></li>
					<li><i class="bx bx-chevron-right"></i>
						<a href="{{ \URL::to('/bugreportform') }}">
						<em class="fa fa-bug"></em> {{ __('footer.bugreport') }}
						</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
	            <div class="col-sm-6 footer-links">
		        </div>    
	            <div class="col-sm-6 footer-links">
		            <div class="social-links mt-3">
		              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
		              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
		              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
		              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
		              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
		            </div>
          		</div>
			</div>
		</div>
	</div>
</footer>
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

