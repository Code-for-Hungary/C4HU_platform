@extends('layouts.app')
@section('content')
<div id="welcomeForm">
      <div class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">

			<section id="hero">
			    <div class="hero-container">
			      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
			
			        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
			
			        <div class="carousel-inner" role="listbox">
			
			          <!-- Slide 1 -->
			          <div class="carousel-item active" style="background-image: url('assets/img/slide/slide-1.jpg');">
			            <div class="carousel-container">
			              <div class="carousel-content container">
			                <h2 class="animate__animated animate__fadeInDown">Üdvözlünk</h2>
			                <p><strong>a C4HU platformon!</strong></p>
			                <p class="animate__animated animate__fadeInUp">Ennek a webhelynek a fejlesztői azt a célt tüzték
			                ki maguk elé, hogy elősegítség a különböző projekteket kezdeményező
			                civil szervezetek (NGO-k) és a különböző feladatokra ű
			                vállalkozó önkéntesek egymásra találását.</p>
			                <a href="{{ url('/') }}#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Bővebben</a>
			              </div>
			            </div>
			          </div>
			
			          <!-- Slide 2 -->
			          <div class="carousel-item" style="background-image: url('assets/img/slide/slide-2.jpg');">
			            <div class="carousel-container">
			              <div class="carousel-content container">
			                <h2 class="animate__animated animate__fadeInDown">
			                	A projekt gazda NGO-k
			                </h2>
			                <p class="animate__animated animate__fadeInUp">
			                Megadhatják projektjük rövid leírását és a megavólsításhoz 
			                keresett önkéntesektől elvárt képességeket.
			                </p>
			                <a href="{{ url('/') }}#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Bővebben</a>
			              </div>
			            </div>
			          </div>
			
			          <!-- Slide 3 -->
			          <div class="carousel-item" style="background-image: url('assets/img/slide/slide-3.jpg');">
			            <div class="carousel-container">
			              <div class="carousel-content container">
			                <h2 class="animate__animated animate__fadeInDown">
			                	Az önkéntes munkára vállalkozók
			                </h2>
			                <p class="animate__animated animate__fadeInUp">
			                pedig a honlapon közzé tehetik, hogy milyen képességekkel 
			                rendelkeznek, és, hogy ezekben mennyire gyakorlottak. A wb oldalt használva 
			                jelentkezhetnek is a kiválasztott projektben történő részvételre.
			                </p>
			                <a href="{{ url('/') }}#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Bővebben</a>
			              </div>
			            </div>
			          </div>
			
			          <!-- Slide 4 -->
			          <div class="carousel-item" style="background-image: url('assets/img/slide/slide-4.jpg');">
			            <div class="carousel-container">
			              <div class="carousel-content container">
			                <h2 class="animate__animated animate__fadeInDown">
			                A projekt gazda NGO -h
			                </h2>
			                <p class="animate__animated animate__fadeInUp">
							a web oldalon közzé tehetik a projekt megvalósulásának előrehaladását. 
							Látható a projektben részvevő önkéntesek száma. A projekt vezető értkelheti 
							is a résztvevők munkáját.			                
			                </p>
			                <a href="{{ url('/') }}#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Bővebben</a>
			              </div>
			            </div>
			          </div>
			
			        </div>
			
			        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
			          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
			        </a>
			        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
			          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
			        </a>
			
			      </div>
			    </div>
			  </section><!-- End Hero -->

	       	 <div style="position:absolute; z-index:10; top:100px; right:10px; 
	       	 			 text-align:center; width:250px; 
				       	 padding:5px; margin:5px; background-color:#efdb9e;
				       	 border-radius:5px;">
				       	<h3>Test loginok:</h3>
				       	demo@test.hu / 12345678<br />
				       	admin@test.hu / 12345678
			</div>
			<a name="about">
				<div style="display:none">
					<form id="logoutForm" method="post" action="/logout">
					@csrf
					</form>
				</div>
				<div id="welcome" class="pageBody max-w-6xl mx-auto sm:px-6 lg:px-8">
				    <div class="welcome-container">
				       	<a name="container"></a>
				       		<h2>Code for Hungary platform</h2>
				       		<img src="{{ url('/') }}/assets/img/logo.png" class="bigAvatar" style="float:left" />
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
            </div>
</div>
@endsection
