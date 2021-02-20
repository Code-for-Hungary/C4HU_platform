# Fogadj örökbe egy weboldalt 

státusz: fejlesztés alatt

Készültség: 1%

Kapcsolodó doksik: [https://drive.google.com/drive/folders/1bj8Zjtp5O1WVJ4coucLoEstYPXpQrEi-](https://drive.google.com/drive/folders/1bj8Zjtp5O1WVJ4coucLoEstYPXpQrEi-)

Chat: [https://codeforhungary.slack.com/archives/C01MV5D61C5](https://codeforhungary.slack.com/archives/C01MV5D61C5)

NGO -k új web oldalainak kialakításához, meglévő  web oldalainak fejlesztéséhez, üzemeltetéséhez önkéntesek toborzása, támogatás nyújtása. Az igények és a jelentkező önkéntesek egymásra találásának elősegítése.

![Logo](public/images/logo.png){height=300}

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
[pixabay](https://pixabay.com/),  [gravatar](http://gravatar.com), [facebook](http://facebook.com), [google](http://google.com), [github](http://github.com)

## Licensz

[MIT license](https://opensource.org/licenses/MIT).

## A repo clonozása utáni teendők

mysql adatbázis létrehozása utf8mb4-hungaian_ci default rendezéssel

.env file editásása (mysql elérés, smtp elérés, opcionálisan github, facebook, google login konfig)

php artisan migrate

## lokális teszt futtatás
```
php artisan serve
```
## Feltöltés WEB szerverre

könyvtár struktúra a web szerveren:
```
    app/                 
    bootstrap/           
    config/
    database/
    public_html/         <- Ez a web szerver DOCUMENT_ROOT (egyes helyeken lehet más a neve)
    resources/
    routes
    storage/
    vendor/
    artisan              
```
upload ennek a reponak a  **public** könyvtárát a **public_html** -be

upload ennek a reponak a többi könyvtárát változatlan néven a web szerverre (a fent megadott könyvtár szerkezetbe)

edit bootstrap/paths.php     a **publik** a **public_html**  -re mutassan

# project alapja 
[https://www.soengsouy.com/2020/12/login-with-laravel-8-and-socialite.html](https://www.soengsouy.com/2020/12/login-with-laravel-8-and-socialite.html)

(továbbiakban: bázis url)

(ez a link tartalmazza  a  facebook, goggle, github konfigurálási utmutatót is)

## A projekt előállítása a bázis laravel -ből kiindulval
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
php artisan migrate
```

edit app/Http/Controllers/auth/LoginConbtroller.php (lásd a fenti bázis url -ben)

copy az új és modositott fájlokat ebből a repo ból a **resources, routes, app** könyvtárakba

