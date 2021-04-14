<div class="js-cookie-consent cookie-consent" style="display:none"> 
	<p style="text-align:center">
	    <span class="cookie-consent__message">
	        {!! trans('cookieConsent::texts.message') !!}
	    </span>
		<br /><br />
	    <button class="js-cookie-consent-agree cookie-consent__agree">
	        {{ trans('cookieConsent::texts.agree') }}
	    </button>
	</p>
</div>

<div id="cookieDisable" style="display:none">
	{{ trans('cookieConsent::texts.disablemessage') }}
	<button type="button" class="btn btn-danger" id="disableButton">{{ trans('cookieConsent::texts.disable') }}</button>
</div>
