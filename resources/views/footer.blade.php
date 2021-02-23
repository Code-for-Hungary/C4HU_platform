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
			<a href="{{ \URL::to('/construction') }}">
				<em class="fa fa-info-circle"></em> {{ __('footer.impressum') }}
			</a><br />
			<a href="https://opensource.org/licenses/MIT" target="_new">
				<em class="fa fa-copyright"></em> {{ __('footer.licence') }}
			</a><br />
			<a href="https://github.com/Code-for-Hungary/fogadj-orokbe-egy-web-oldalt" target="_new">
				<em class="fa fa-code"></em> {{ __('footer.source') }}
			</a><br />
			<a href="{{ \URL::to('/construction') }}">
				<em class="fa fa-bug"></em> {{ __('footer.bugreport') }}
			</a><br />
		
		</div>
	</div>
</div>
@include('cookieConsent::index')
