# Fogadj örökbe egy weboldalt 

státusz: fejlesztés alatt

Készültség: 95%  v0.04-alpha

Verzió történet:

v0.01 2021.02.21 e-mail ellenörzés branch: developer-emailverify

v0.02 2021.02.25 footer branch: developer-footer

v0.03            user profile  branch: developer-profile

Kapcsolodó doksik: [https://drive.google.com/drive/folders/1bj8Zjtp5O1WVJ4coucLoEstYPXpQrEi-](https://drive.google.com/drive/folders/1bj8Zjtp5O1WVJ4coucLoEstYPXpQrEi-)

Chat: [https://codeforhungary.slack.com/archives/C01MV5D61C5](https://codeforhungary.slack.com/archives/C01MV5D61C5)

NGO -k új web oldalainak kialakításához, meglévő  web oldalainak fejlesztéséhez, üzemeltetéséhez önkéntesek toborzása, támogatás nyújtása. Az igények és a jelentkező önkéntesek egymásra találásának elősegítése.

[Élő demo](http://utopszkij.tk)

![Logo](public/images/logo.png)

## Áttekintés

Egy web oldal ahová regisztrálhatnak weboldalt működtető vagy azt tervező NGO -k és önkéntesek akik web oldal müködtetésre, fejlesztésre vállalkoznak. MIndkét csoport a megszokott módon regisztrálhat usernév+jelszó megadásával vagy facebook/google/github segítségével.

A weboldal működtető NGO -k megadják a weboldalakkal kapcsolatos elvárásaikat  adatokat, valamint azt, hogy milyen feladatra keresnek önkénteseket.

Az önkéntesek böngészhetik a feltöltött adatokat, keresési lehetőség, szűrési lehetőség is van,  Ha vállalkoznak egy feladat elvégzésére, azt egy gombra kattintással jelezhetik, ez esetben megkapják a web oldal üzemeltető által megadott elérhetőségi informáciokat.Egy link segitségével emailt küldhetnek az NGO -nak (de az NGO email címét nem látják)

A weboldal üzemeltető NGO a kapcsolatfelvétel után jelezni tudja a rendszerben, hogy a feladat folyamatban van, illetve a munka elvégzése után a feladat lezárását is. Illetve törölhetik az önkéntes jelentkezését.Továbbá értékelheti az önkéntes munkáját is (szöveges értékelés, és pontszám).

Az önkéntesek visszavonhatják saját jelentkezésüket, addig amíg a feladat státusza még “feladat” állapotot mutat.

A weboldalon a regisztrált önkéntesek listája is böngészhető, publikus profil adatok lekérdezhetőek és láthatóak a róluk adott értékelések is. Nekik is lehet link segítségével email küldeni (az email cím itt sem publikált)

A weboldal elsősorban desctop/laptop/table használatra legyen optimalizálva, persze azért a telon -való használatot sem kizárva.

Sotware: Laravel  8.28.1 alapon készül. lásd: [laravel-readme.md](laravel-readme.md) és [laravel.com](http://laravel.com)

További felhasznált szellemi termékek: [jQuery](http://jquery.com), [bootstrap](https://getbootstrap.com/), [Awesore fonts](https://fontawesome.com/),
[pixabay](https://pixabay.com/),  [gravatar](http://gravatar.com), [facebook](http://facebook.com), [google](http://google.com), [github](http://github.com),
[spatie cookie consent](https://github.com/spatie/laravel-cookie-consent)

## Licensz

[MIT license](https://opensource.org/licenses/MIT).

## A repo clonozása utáni teendők

mysql adatbázis létrehozása utf8mb4-hungaian_ci default rendezéssel

.env file editásása (mysql elérés, smtp elérés, opcionálisan github, facebook, google login konfig)

composer install
php artisan migrate --seed

## lokális teszt futtatás
```
php artisan serve
```
## tests
```
php artisan test
```
## Feltöltés WEB szerverre

1. MYSQL adatbázis létrehozása (utf8m4_hunagrain_ci illesztéssel) és kezdeti feltöltése (parancssori mysql vagy phpmyadmin -al)

2. .env módosítása az aktuális adatbázis elérés ,levelezési és web site url beállításokhoz.

3. A továbbiak attól függően másként alakulnak, hogy van-e lehetőségünk a web szerver document_root modosítására.

3.1 ha van lehetőségünk a szerveren a document_rot modositására:
 
könyvtár struktúra a web szerveren:

```
    app/                 
    bootstrap/           
    config/
    database/
    public/         <- Ide mutasson a web szerver document_root!
    resources/
    routes
    storage/
    vendor/
```

fájlok a fő könyvtárban: .env, server.php, artisan

3.2 Ha nincs lehetőségünk a document_root modositására:

könyvtár struktúra a document_root alatt:

```
    app/                 
    bootstrap/           
    config/
    database/
    resources/
    routes
    storage/
    vendor/
```

fájlok a fő könyvtárban: .env, server.php, artisan

A public könyvtár tartalmát (alkönyvtárakkal együtt) is a document_root -ba töltsük fel.

Az index.php -t modositsuk, töröljünk minden file utvonalból a "../" részt.

Mindkét módszer setén fontos, hogy a "storage" mappát kivéve a többi csak olvasható legyen,
a "storage" legyen írható is a web szerver számára.

# project alapja 
[https://www.soengsouy.com/2020/12/login-with-laravel-8-and-socialite.html](https://www.soengsouy.com/2020/12/login-with-laravel-8-and-socialite.html)

(továbbiakban: bázis url)

(ez a link tartalmazza  a  facebook, goggle, github konfigurálási utmutatót is)

## A projekt előállítása a bázis laravel -ből kiindulva
```
composer create-project --prefer-dist laravel/laravel LaravelSocialite 
cd LaravelSocialite
```
edit .env file (mysql access, smtp access, sociál login access)
```
composer require laravel/ui
npm run dev
php artisan ui:auth      (answer "yes" for all questions)
composer require laravel/socialite
php artisan make:controller LoginController
```
edit config/services.php  (mysql access)
``
edit database/migration/.....create_users_table.php (lásd a fenti **bázis url** -ben)
```
php artisan migrate --seed
```

edit app/Http/Controllers/auth/LoginConbtroller.php (lásd a fenti bázis url -ben)

```
composer require spatie/laravel-cookie-consent
php artisan vendor:publish --provider="Spatie\CookieConsent\CookieConsentServiceProvider" --tag="config"
```
copy az új és modositott **.env**, **.env.testing** fájlokat és a   
**resources, routes, app** könyvtárakban lévő (belértve az alkönyvtárakat is) 
 új és modosított fájlokat.


