<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    	@include('htmlhead')
    </head>
    <body class="antialiased">
        <div id="app" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
	    	@include('navbar')
	    	
            <div id="welcome" class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
            	<div class="welcome-container">
            		<h2>{{ env('APP_NAME') }}</h2>
            		<img src="/images/logo.png" />
            		<p>NGO -k új web oldalainak kialakításához, meglévő  web 
oldalainak fejlesztéséhez, üzemeltetéséhez önkéntesek toborzása, támogatás nyújtása. 
Az igények és a jelentkező önkéntesek egymásra találásának elősegítése.
Erre a web oldalra regisztrálhatnak weboldalt működtető vagy azt tervező NGO -k 
és önkéntesek akik web oldal müködtetésre, fejlesztésre vállalkoznak. 
Mindkét csoport a megszokott módon regisztrálhat usernév+jelszó megadásával 
vagy facebook/google/github segítségével.
</p>
<p>
A weboldal működtető NGO -k megadják a weboldalakkal kapcsolatos elvárásaikat  
adatokat, valamint azt, hogy milyen feladatra keresnek önkénteseket.
Az önkéntesek böngészhetik a feltöltött adatokat, keresési lehetőség, szűrési 
lehetőség is van,  Ha vállalkoznak egy feladat elvégzésére, azt egy gombra 
kattintással jelezhetik, .Egy link segitségével emailt küldhetnek 
az NGO -nak.
</p>
<p>
A weboldal üzemeltető NGO a kapcsolatfelvétel után jelezni tudja a rendszerben, 
hogy a feladat folyamatban van, illetve a munka elvégzése után a feladat 
lezárását is. Illetve törölhetik az önkéntes jelentkezését.Továbbá értékelheti 
az önkéntes munkáját is (szöveges értékelés, és pontszám).
</p>
<p>
Az önkéntesek visszavonhatják saját jelentkezésüket, addig amíg a feladat 
státusza még “feladat” állapotot mutat.
A weboldalon a regisztrált önkéntesek listája is böngészhető, publikus 
profil adatok lekérdezhetőek és láthatóak a róluk adott értékelések is. 
Nekik is lehet link segítségével email küldeni (az email cím itt sem publikált)
</p>
                </div>
            </div>
   			@include('footer')
        </div>
    </body>
</html>
