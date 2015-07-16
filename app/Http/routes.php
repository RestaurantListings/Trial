<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::post('/search', array('as'=>'search','uses'=> function(){
        $recent = \App\Restaurants::all();

        return View::make('search')->with('recent', $recent);
    }));
Route::get('restaurants/{permalink}', function($permalink)
{
    $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
    $data['reviews'] = \App\Restaurant_Reviews::where('restaurant_id', '=', $data['restaurant'][0]['id'])->get();

    return View::make('restaurant')->with('data', $data);
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
