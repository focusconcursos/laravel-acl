<?php

/*
|--------------------------------------------------------------------------
| Admin area Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
| AdminController acts as a parent controller for others in the
| App\Http\Controllers\Admin namespace
|
*/

Route::group(['middleware' => ['web', 'auth', 'acl']], function () {
    Route::resource('permissions', 'Mahesvaran\LaravelAcl\Controllers\PermissionsController');
    Route::resource('roles', 'Mahesvaran\LaravelAcl\Controllers\RolesController');
    Route::get('users/{user}/roles', 'Mahesvaran\LaravelAcl\Controllers\RolesController@showRoles');
    Route::get('users/{user}/roles/edit', 'Mahesvaran\LaravelAcl\Controllers\RolesController@editRoles');
    Route::post('users/{user}/roles/update', 'Mahesvaran\LaravelAcl\Controllers\RolesController@updateRoles');
});
