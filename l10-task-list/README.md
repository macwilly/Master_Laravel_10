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
`@csrf` directive - (cross site request forgery) this directive helps to protect again csrf attacks. Creates a unique token that laravel will check. If you do not include `@csrf` forms system will throw a 419 error.  


### Validating_and_Storing_Data

`$data = $request->validate([
        'title'            => 'required|max:255',
        'description'      => 'required',
        'long_description' => 'required'
    ]);` This is creating a new variable data that has all of the information from the form request. To validate it we create a key value array with the form input names with the validation rules. If a form field has more than one 
    rule then a | is used to separate it.  
If the form does not validate Laravel will set a $_SESSION variable call errors and return the user to previous page so that the errors can be displayed next to fields.  
`$[model]->save()` this is a prebuild function for Laravel models. It know if you create a new model class to do an insert and if it is an exisitig model to do an update.  



### Sessions_Errors_and_Flas_Messages

By default session information is stored in /storage/framework/sessions  
The session behavior can be changed in config/session.php  


### Edit_Form

`method('PUT')` this directive adds another data field to be sent with the form which is _method=put this is a form of method spoofing.
Internally Laravel will see the POST method from the form as well as the PUT method and will know to redirect to a route with a PUT method (`Route::put`)  
When running the put method we can still use the save() method on the model, because Laravel knows to do an update on an existing database field.  


### Keeping_Old_Values_in_the_Form

This is a UI friendly tip for when validating forms.  
the `old('[inputName]')` will save the previously used information from the field if there was an error with submition.  
Will only work with forms that are using POST.  


### Reusability_Route_Model_Binding_Form_Requests_Mass_Assignment

Route Model Binding: Feature in Laravel where Laravel will automatically resolve a model instance based on type of Model that is passed.
This means in the parameters you pass Object objectName. Laravel will automatically fetch the Model from the database, and if not will
throw a not found (404). This can replace our Model::findOrFail() . The task that is passed in the Route path is assumed by Laravel to be
the primary key. This can be configured in the Model class page app/Models/ by implimenting the method `public function getRouteKeyName(){}`  
`php artisan make:request [name]` this is used to create a form request which can be used to group validation together for re-useability. If
you have different validations for create/update you can create a form request for both.  
To get the validated data from the new Request class.  
- Import the new class at the top of `web.app` `use App\Http\Requests\[requestName];`
- Where before a generic `Request` was used change to be new request class
- change your `$data` to be `$data = $request->validated()` this will use the validated information from the Request Class. If it 
does not validate, the errors will be returned as before. `validated()` returns a key value array.  
`Model::create()` this static method of all models is used to mass assign the values of the model. This method takes a key value array to set all of 
the Model.  
`$model->update()` this static method of all models is used to mass assign the values of the model. This method takes a key value array to set all of 
the Model and will update it.  
By default these two above mass assignments are not enabled. This is to prevent users from updating fields that they shouldn't update. To enable this 
add `protected $fillable = ['columnName1', 'columnName3']` to the desired Model. More secure because each field is specifically called out.  
`protected $guarded = ['columnName2', 'columnName4']` is the opposite of `$fillable` it allows you to chose which fields are not fillable and the rest will be allowed.  


### Deleting_Data

`$model->delete()` built in method from Model that will delete the record from the database.  
In Laravel the Routes that delete something are named common prefecix for the model and `.destroy`  


### Reusing_Blade_Code_Subviews

This was mostly just in the code.  
Using the `??`  if the value before the `??` is not null use it else use the later.  
`include()` directive will bring in the sub views to be used. Till you know what the form will look like, it will be a good idea to make a create and edit form. 
Then if it makes sense refactor into a subview. There is a newer directive that will be taught later and `include()` is for more simple cases.  


### Adding_Pagination

Laravel has a built in pagination feature.
`paginate()` built in Model method. Will call `get()` and make sure that the results are spilt correctly. 
It will also provide links to other pages for the blades. It also reads any query parameters what were sent to the route.


### Toggling_Task_State

Explored two ways to toggle the completed field.  
- The first way was only through the route and using build in Model methods.  
- The second was by adding a method to the Model. Same method just encapsulating it better.  

When modify data it is best practice to use POST or PUT html verbs and never GET. GET should be used for data retrieval.


### Adding_Styling_with_Tailwind_CSS 

[Tailwind CSS](https://tailwindcss.com/).  
`cdn` Contenet delivery network.  It is a distributed network of servers and deliver content to users based on geographical location. 
It will improve performace and reduce latency.  
`@class()` directive. 
- This is used to add classes to an element. 
- It requries an array of values.
- You can have a class always applied
- you can have a class conditionally applied with a key value. where key is the class(es) and value is the condition. Multiple classes
are separated by ` `