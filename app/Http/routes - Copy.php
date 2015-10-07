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
        echo 'Hello';
        exit;
        $recent = \App\Restaurants::all();

        return View::make('search')->with('recent', $recent);
    }));
Route::get('/b/{permalink}', function($permalink)
    {
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
        $data['reviews'] = \App\Restaurant_Reviews::paginate(200);

        return View::make('blank_test')->with('data', $data);
    }
);
Route::get('/blank/{id}', function($id)
    {
        $data['reviews'] = \App\Restaurant_Reviews::paginate(350);

        return View::make('blank')->with('data', $data);
    }
);

Route::get('/restaurants/next_reviews/{id}', function($id)
    {
        $data['reviews'] = \App\Restaurant_Reviews::where('restaurant_id', '=', $id)->paginate(50);

        return View::make('next_review_box')->with('data', $data);
    }
);
Route::get('restaurants/{permalink}', function($permalink)
{
    $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
    //$data['reviews'] = \App\Restaurant_Reviews::where('restaurant_id', '=', $data['restaurant'][0]['id'])->paginate(40);
    $data['reviews'] = \App\Restaurant_Reviews::paginate(200);

    return View::make('restaurant')->with('data', $data);
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::post('/{name?}',['as' => 'banner_search', 'uses' => 'SearchController@bannerSearch']);

Route::post('/searching',['as' => 'process_search', 'uses' => 'SearchController@searchRestaurant']);

Route::post('/search',function(){
    array(['as' => 'banner_search', 'uses' => 'SearchController@bannerSearch']);});