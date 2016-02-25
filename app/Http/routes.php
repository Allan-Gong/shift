<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth(); // shortcut to define authentication related routes (e.g.login, logout, register, password reset)

    Route::get('/',     'HomeController@index');
    Route::get('/home', 'HomeController@index');

    // Protected routes for logged-in users
    Route::group(['middleware' => 'auth'], function () {

        // Routes for Shift
        Route::resource("shifts", "ShiftController");
        Route::get('shifts/delete/{id}', [
            'as'   => 'shifts.delete',
            'uses' => 'ShiftController@destroy',
        ]);
        Route::post('shifts/delete/{id}', [
            'as'   => 'shifts.delete',
            'uses' => 'ShiftController@destroy',
        ]);

        // Routes for Role
        Route::resource("roles", "RoleController");
        Route::get('roles/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'RoleController@destroy',
        ]);

        // Routes for Venue
        Route::resource("venues", "VenueController");
        Route::get('venues/delete/{id}', [
            'as' => 'venues.delete',
            'uses' => 'VenueController@destroy',
        ]);

    });
});



/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function ()
{
	Route::group(['prefix' => 'v1'], function ()
	{
        require config('infyom.laravel_generator.path.api_routes');
	});
});

