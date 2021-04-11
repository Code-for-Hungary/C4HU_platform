@extends('layouts.app')
@section('content')
<div>
            <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">

				<div style="display:none">
					<form id="logoutForm" method="post" action="/logout">
					@csrf
					</form>
				</div>
				<main class="pageBody py-4">
				<div id="welcome" class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
					<div class="intro">
				       	<div style="text-align:center; width:auto; float:right;
				       	    padding:5px; margin:5px; background-color:#efdb9e;
				       	    border-radius:5px;">
				       		<h3>Test loginok:</h3>
				       		demo@test.hu / 12345678<br />
				       		admin@test.hu / 12345678
				       	</div>
				       	<a href="#container" class="btn btn-secondary">Leírás</a>
				    </div>   	
				    <div class="welcome-container">
				       	<a name="container"></a>
				       		<h2>Code for Hungary platform</h2>
				       		<img src="{{ url('/') }}/images/logo.png" class="bigAvatar" style="float:left" />
							<p>NGO -k új projektjeik kialakításához, meglévő  informatikai  
								funkcióik fejlesztéséhez, üzemeltetéséhez önkéntesek toborzása, támogatás nyújtása. 
								Az igények és a jelentkező önkéntesek egymásra találásának elősegítése.
								Erre a web oldalra regisztrálhatnak projekt gazda NGO -k 
								és önkéntesek akik önkéntes munkára vállalkoznak. 
								Mindkét csoport a megszokott módon regisztrálhat usernév+jelszó megadásával 
								vagy facebook/google/github segítségével.
							</p>
							<p>
								A projekt gazda NGO -k megadják a projekttel kapcsolatos elvárásaikat  
								adatokat, valamint azt, hogy milyen feladatra keresnek önkénteseket.
								Az önkéntesek böngészhetik a feltöltött adatokat, keresési lehetőség, szűrési 
								lehetőség is van,  Ha vállalkoznak egy feladat elvégzésére, azt egy gombra 
								kattintással jelezhetik, .Egy link segitségével emailt küldhetnek 
								az NGO kapcsolattartónak.
							</p>
							<p>
								A projekt gazda NGO a kapcsolatfelvétel után jelezni tudja a rendszerben, 
								hogy a feladat folyamatban van, illetve a munka elvégzése után a feladat 
								lezárását is. Illetve törölhetik az önkéntes jelentkezését.Továbbá értékelheti 
								az önkéntes munkáját is (szöveges értékelés, és pontszám).
							</p>
							<p>
								A weboldalon a regisztrált önkéntesek listája is böngészhető, publikus 
								profil adatok lekérdezhetőek és láthatóak a róluk adott értékelések is. 
								Nekik is lehet link segítségével email küldeni. 
							</p>
					</div>
				</div>			
				</main>
            </div>
</div>
@endsection
