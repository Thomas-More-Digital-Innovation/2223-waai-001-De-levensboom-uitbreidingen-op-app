# Webapp Documentation

## Installation
The documentation for the installation can be found in the first readMe of the project.

### Front end
For the front end we use laravel breeze along with some javascript where needed.

### Swagger/open api documentation
Our documentation is done inside the source code of the webapp, this is done by using the L5-swagger package to translate the comments to open api documentation. \
You can find the documentation on 127.0.0.1/api/documentation, here you will see all the routes seperated by their tags and all the schemas needed.

### Laravel API
- All routes: All routes for the api can be found in the file "routes/api.php", if you call an api you will start in this file. Here all routes get connected to the API controller with the middleware who will provide the authentication.
  
- API controllers: All API controllers can be found in the "App/Http/Controllers/Api/..." folder. In these controllers you can see all the different methods for each api/controller, this is also where you define which data gets send back on a request. Important to notice is the Store...Request parameter in the update and store methods, your request will first pass those files and do the necessary checks.

- API data rules: All API rules can be found in the "App/Http/Requests/Store...Request", the update and store methods will pass these rules which you can set yourself and check if they match before doing the method requested.

### Login
For the login we have used a laravel breeze package.
- Secure the web routes: All web routes can be found in "routes/web.php", this is where they are secured by the middleware who checks if you are authenticated ('auth') and if your mail is verified ('verified').

- Login routes: All login routes can be found in "routes/auth.php", this is where all the routes are for the login. Here the middleware will check if you are logged in ('auth') or not logged in ('guest'). The same as the routes with the 'auth' middleware.

- Auth controllers: All the auth controllers can be found in "app/Http/Controllers/Auth/...", all the controlers needed for the login can be found here where they will be called by the auth routes.

### UserTypes
| Name | Id |
| --- | --- |
| Admin | 1 |
| Client | 2 |
| Mentor | 3 |

### Roles
| Name | Id |
| --- | --- |
| Department Head | 1 |
| Client | 2 |
| Mentor | 3 |

### Permissions
- Clients - None
- Mentors - View everything
- Department Head - All of above, add/edit/delete users, edit own department
- Admin - All of above, everything else

### Custom mails
Met Laravel 9 kun je custom mails toevoegen aan je applicatie. Dit betekent dat je aangepaste e-mails kunt maken die je naar gebruikers kunt sturen, bijvoorbeeld om hen op de hoogte te brengen van een wijziging in hun account, een nieuw product of een ander belangrijk bericht.

- Notification genereren
Om custom mails te kunnen verzenden, begin je met het genereren van een notification. Dit is een notificatie die wordt verzonden wanneer er een specifiek event plaatsvindt, bijvoorbeeld wanneer een gebruiker zich registreert op je website. Notifications worden in Laravel 9 gegenereerd met behulp van de make:notification Artisan commando.

- Mailable genereren
Om ervoor te zorgen dat die niet langs de standaard mail template gaat genereer je een mailable. In die mailable zet je een aantal variabellen die je naar je blade template stuurt. Je kunt een mailable genereren met behulp van de make:mail Artisan commando.

- Mail verzenden
Nu je de notification en de mailable hebt gegenereerd en de variabelen hebt ingesteld, kun je de mail verzenden. Dit kun je doen door de notify methode aan te roepen op de notification klasse.
"$user->notify(new UserRegistered());"

- Template styling
Als laatste stap kun je de styling van de e-mails aanpassen. De standaard styling van de e-mails is te vinden onder resources/vendor/mail. Als je de template van de notification wilt aanpassen, kun je deze vinden onder resources/vendor/notification.

