<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

# Course Notes

### Connecting_to_Database_From_Laravel

The sections was more about using Laravel to create a new Database from the .env 
To do this we stopped the server that was running then ran the `php artisan migrate` command
Upon running the command in the Docker instance of MySQL the new database was created with with the name from .env 
Also some default Laravel tables were created.

### Models_and_Migrations

Every database table has a model which is found in app/Models/  
Model names should be singular so you want to name it Task and not Tasks. This is because
Laravel infures from the model name that a database table will be created and that will use the plural.  
To create a new one we use the command `php artisan make:model Task -m` 
this will create a new model called Task and the -m flage will create the migration file.  
The migration files are located in database/migrations/  
Migrates are used as a version controll of the database through php (Laravel)  
When you create a new migration you add all the information to the `up()` function this is for upgrding the database.
This uses all objects to create the comlumns. `id()` and `timestamp()` are built in types.  
The `down()` function is used to rollback the changes.  
To run the mirgration you use `php artisan migrate`  
To rollback you will use `php artisan migrate:rollback`  


### Model_Factory_and_Seeder

**Factory** is used to generate fake data.  
**Seeder** is used to add the fake data to the database.  
Both can be found in the database directory. 
You can use the command `php artisan make:factory [FactoryName]` to create a new factory. You can also generate with factories as well.   
To have a Factory for your model the /Models/[Model].php must have `use HasFactory;` this is automatically added when the Model is created with Laravel.
To be able to seed your database you will use the command `php artisan db:seed` this will look at the 
seeders and make the appropriate calls to create factory data and insert it into the database.  
The `db:seed` will always add new data it is not refreshing it.  
Seeding is typically done as the inital set up of a Laravel Application.  
To have Laravel create a new Factory run the command `php artisan make:factory [ModelNameFactory] --model=[ModelName]`  
The example from the lesson is `php artisan make:factory TaskFactory --model=Task`  
`php artisan migration:refresh --seed` this will run all of the migrations from the top. It will **COMPLETELY RECREATE THE DATABASE**. After recreating the tables it Laravel will then use the seeder to populate them.  


### Model_and_Reading_Data

`latest()->get()` Latest creates a query build just like the one that I created for work. It will make the specific SQL query. get() will exicute the query and return the results.  
You can call multiple query builder methods to add on Query modifiers.   
- [Building Queries](https://laravel.com/docs/10.x/queries).  
From the command line use `php atrisan tinker` to interact with the database models without needed to render in web page.  Use the same commands as in the web application. Good way to look at data before using the web page.  
**Example** `\App\Models\Task::where('completed', false)->get()->count();`


### Forms_and_CSRF_Protection

The order that the routes are defined matter.  
Routes that accept a parameter are known as greedy and should be placed lower in the defined routes to all other set routes to be caught.  
To see all the routes in a project use `php artisan route:list`  
When ou use a different route method the path can be the same. 
`@csrf` directive - (cross site request forgery) this directive helps to protect again csrf attacks.