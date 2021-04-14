@if($cookieConsentConfig['enabled'] || ! $alreadyConsentedWithCookies)
    @include('cookieConsent::dialogContents')
    <script>
        window.laravelCookieConsent = (function () {
            const COOKIE_VALUE = 1;
            const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';
            function consentWithCookies() {
                setCookie('{{ $cookieConsentConfig['cookie_name'] }}', COOKIE_VALUE, {{ $cookieConsentConfig['cookie_lifetime'] }});
                hideCookieDialog();
            }
            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }
            function hideCookieDialog() {
            	document.getElementById('cookieDisable').style.display="block";
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }
            function showCookieDialog() {
            	document.getElementById('cookieDisable').style.display="none";
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'block';
                }
            }
            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/{{ config('session.secure') ? ';secure' : null }}'
                    + '{{ config('session.same_site') ? ';samesite='.config('session.same_site') : null }}';
            }
            function getCookie(c_name) {
                if (document.cookie.length > 0) {
                    c_start = document.cookie.indexOf(c_name + "=");
                    if (c_start != -1) {
                        c_start = c_start + c_name.length + 1;
                        c_end = document.cookie.indexOf(";", c_start);
                        if (c_end == -1) c_end = document.cookie.length;
                        return unescape(document.cookie.substring(c_start, c_end));
                    }
                }
                return "";
            }            
	        function setCookieDisable() {
				setCookie('laravel_cookie_consent',0,0);
				document.location="/";            
    	    }

            if (cookieExists('{{ $cookieConsentConfig['cookie_name'] }}')) {
            	const c = getCookie('laravel_cookie_consent');
            	if (c == 1) {
                	hideCookieDialog();
                } else {
	                showCookieDialog();
                }	
            } else {
                showCookieDialog();
            }
            const buttons = document.getElementsByClassName('js-cookie-consent-agree');
		    for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }
            const button2 = document.getElementById('disableButton');
            button2.addEventListener('click', setCookieDisable);
            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();

    </script>

@endif