### Hoe uploaden op one.com
1. Pull de laatste nieuwe versie
2. Voordat je lokaal kan builden moet je 2 andere terminals hebben aan staan met php artisan serve en npm run dev
3. Build het project lokaal met het command npm run build
4. Zip de webapp folder
5. Upload de zip naar one.com file manager
6. Unzip het hier en wacht tot deze voltooid is
7. Zorg er ten alle tijden voor dat private_key.pepk en upload-keystore.jks aanwezig zijn in deze files
8. Maak een .env file aan
9. htaccess moet er als volgt uit zien, anders werkt het niet. Dit is omdat one.com een shared hosting is. De ht access moet zowel op de root als in de public folder aanwezig zijn.
Root:
```
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{HTTPS} !=on
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    RewriteCond %{REQUEST_URI} !^public
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```
Public:
```
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

```
10. Maak een tijdelijke nieuwe route aan om het commando php artisan migrate uit te voeren (1 keer)
```
Route::get('/run', function () {
    Artisan::call("migrate");
    dd("migrated");
});
```
10. Ga naar deze route om dit commando uit te voeren
11. Kijk of de webapp werkt, zo ja delete de route

12. Zorg ervoor dat er GEEN "hot" file in de map public aanwezig is