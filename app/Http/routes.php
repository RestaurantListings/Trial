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

Route::post('/search', array('as'=>'search', 'uses'=>'SearchController@homeSearch'));
//Route::post('/search',function(){
  //  array(['as' => 'search', 'uses' => 'SearchController@homeSearch']);});
//Route::post('/search', array('as'=>'search','uses'=> function(){
  //      $data = Input::all();
        //$recent = \App\Restaurants::where('name', 'like', '%'.$data['restaurant_name'].'%')->take(10)->get();

        //echo '<pre>';
    //    var_dump($data);
        //echo '</pre>';
        //return View::make('search')->with('recent', $recent);
    //}));
Route::get('/b/{permalink}', function($permalink)
    {
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
        $data['reviews'] = \App\Restaurant_Reviews::paginate(200);

        return View::make('blank_test')->with('data', $data);
    }
);
Route::get('/two/{permalink}', function($permalink)
    {
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
        $data['reviews'] = \App\Restaurant_Reviews::paginate(2);

        return View::make('blank_test')->with('data', $data);
    }
);
Route::get('/ten/{permalink}', function($permalink)
    {
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
        $data['reviews'] = \App\Restaurant_Reviews::paginate(10);

        return View::make('blank_test')->with('data', $data);
    }
);
Route::get('/forty/{permalink}', function($permalink)
    {
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
        $data['reviews'] = \App\Restaurant_Reviews::paginate(40);

        return View::make('blank_test')->with('data', $data);
    }
);
Route::get('/hundred/{permalink}', function($permalink)
    {
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->get();
        $data['reviews'] = \App\Restaurant_Reviews::paginate(100);

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
   // $data['reviews'] = \App\Restaurant_Reviews::paginate(200);

    return View::make('restaurant')->with('data', $data);
});


Route::get('voice', function() {
    return View::make('voice');
});
Route::post('voice', 'SearchController@voice');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

