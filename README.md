# laravel-acl
A simple role and permission based laravel acl package

## How it works
In simple manner `permissions` are route names.

For example in your app contains route like
``` php
Route::resource('posts', 'PostsController');
```
Then your route table looks like
``` bash
$ php artisan route:list
+--------+-----------+--------------------+---------------+----------------------------------------------+------------+
| Domain | Method    | URI                | Name          | Action                                       | Middleware |
+--------+-----------+--------------------+---------------+----------------------------------------------+------------+
|        | GET|HEAD  | posts              | posts.index   | App\Http\Controllers\PostsController@index   | web        |
|        | POST      | posts              | posts.store   | App\Http\Controllers\PostsController@store   | web        |
|        | GET|HEAD  | posts/create       | posts.create  | App\Http\Controllers\PostsController@create  | web        |
|        | DELETE    | posts/{posts}      | posts.destroy | App\Http\Controllers\PostsController@destroy | web        |
|        | PUT|PATCH | posts/{posts}      | posts.update  | App\Http\Controllers\PostsController@update  | web        |
|        | GET|HEAD  | posts/{posts}      | posts.show    | App\Http\Controllers\PostsController@show    | web        |
|        | GET|HEAD  | posts/{posts}/edit | posts.edit    | App\Http\Controllers\PostsController@edit    | web        |
+--------+-----------+--------------------+---------------+----------------------------------------------+------------+
```

So in this package permissions are the name of your app's routes.

## Install

Begin by installing this package through Composer.
Edit your project's composer.json file to require `mahesvaran/laravel-acl`.

``` bash
"require": {
    "mahesvaran/laravel-acl": "dev-master"
}
```
Next, update Composer from the Terminal:

``` bash
composer update
```

Next, add your new provider to the providers array of `config/app.php`:

``` php
'providers' => [
    // ...
    Mahesvaran\LaravelAcl\LaravelAclServiceProvider::class,
    // ...
  ],
```
Finally, add acl to the application's route middleware list `app/Http/Kernel.php`
``` php
protected $routeMiddleware = [
    // ...
    'acl' => \Mahesvaran\LaravelAcl\Middleware\LaravelAcl::class
    // ...
];
```


Publish config file & generator template files.
``` bash
php artisan vendor:publish
```
Add the following code to your `database\seeds\DatabaseSeeder.php`
``` php
    public function run()
    {
        // ...
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // ...
    }
```
Run the following commands

``` bash
composer dump-autoload
php artisan migrate
php artisan db:seed
```

Include roles related functions to your user model. Open `User.php`
``` php
...
use Mahesvaran\LaravelAcl\Traits\RoleTrait;
class User extends Authenticatable
{
    use RoleTrait;
    ...
```

Finally, update the following code to your `AuthServiceProvider.php`
``` php
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // ...

        foreach ($this->getPermissions() as $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }
        // Give all privileges to system administrator
        $gate->before(function ($user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

    }

    protected function getPermissions()
    {
        if (\Schema::hasTable('permissions')) {
            return \Mahesvaran\LaravelAcl\Models\Permission::with('roles')->get();
        } else {
            return [];
        }
    }
```
Run your app
``` bash
php artisan make:auth
php artisan serve
```
[http://localhost:8000](http://localhost:8000)
login to your app using the super admin credentials defined [here](https://github.com/mahesvaran/laravel-acl/blob/master/database/seeds/UsersTableSeeder.php#L20-L21).
Once you logged in you can create new roles and assign permissions to them.

You can assign roles to your users by setting up the following route
```
http://localhost:8000/users/{id}/roles/
```


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
