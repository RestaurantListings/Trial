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
use Jenssegers\Agent\Agent;



Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::post('/search', array('as'=>'search', 'uses'=>'SearchController@homeSearch'));

Route::get('/search', function()
{
    DB::connection()->enableQueryLog();
    $user_config=array('keywords'=>\Input::get('keywords'),'location'=>\Input::get('location'));
    if(!is_numeric($user_config['location'])){
        if(strpos($user_config['location'], "'") === false){
            $data['location'] = $user_config['location'];

            //Get the filter options matching the location
            $data['filter_options']['city'] = DB::table('city')->take(5)->get();

            //Get restaurants matching the keywords and the location
            $data['restaurants'] = DB::table('restaurants')
                ->join('city', 'city.id', '=', 'restaurants.city_id')
                ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
                ->where(function($query) use($user_config){
                    $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                        ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

                })
                ->where('city.city', '=', $data['location'])
                ->orderBy('restaurants.rank', 'desc')
                ->orderBy('restaurants.categories', 'asc')
                ->paginate(10);
        }else{
            $loc = explode(', ', $user_config['location']);
            $data['search_city'] = $loc[0];
            $data['search_state'] = $loc[1];
            $data['location'] = $data['search_city'].', '.$data['search_state'];

            //Get the filter options matching the location
            $data['filter_options']['city'] = DB::table('city')->take(5)->get();

            //Get restaurants matching the keywords and the location
            $data['restaurants'] = DB::table('restaurants')
                ->join('city', 'city.id', '=', 'restaurants.city_id')
                ->join('state', 'state.id', '=', 'restaurants.state_id')
                ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
                ->where(function($query) use($user_config){
                    $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                        ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

                })
                ->where('city.city', '=', $loc[0])
                ->where('state.short', '=', $loc[1])
                ->orderBy('restaurants.rank', 'desc')
                ->orderBy('restaurants.categories', 'asc')
                ->paginate(10);
        }

    }else{
        //Assign zip code to the data
        $data['location'] = $user_config['location'];

        //Get the filter options matching the location
        $data['filter_options']['city'] = DB::table('city')->take(5)->get();

        //Get restaurants matching the keywords and the location
        $data['restaurants'] = DB::table('restaurants')
            ->join('city', 'city.id', '=', 'restaurants.city_id')
            ->join('state', 'state.id', '=', 'restaurants.state_id')
            ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
            ->where(function($query) use($user_config){
                $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                    ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

            })
            ->where('restaurants.zip', 'LIKE', $user_config['location'])
            ->orderBy('restaurants.rank', 'desc')
            ->orderBy('restaurants.categories', 'asc')
            ->paginate(10);
    }
    //dd($data);
     foreach($data['restaurants'] as $r){
        if($r->hours != ''){
            $hours = explode('||', $r->hours);
            foreach($hours as $h)
            {
                $ho = explode(' -->', $h);
                if((date('D') == str_replace(' ', '',$ho[0])) && ($ho[1] == 'Closed')){
                    $r->id = $r->restaurants_id;
                    $td_hours = explode('-', $ho[1]);
                    $open_time = strtotime(str_replace(' ', '', $td_hours[0]));
                    $close_time = strtotime(str_replace(' ', '', $td_hours[1]));
                    if((strtotime(date('g:ia')) > $open_time) && (strtotime(date('g:ia')) < $close_time))
                    {
                        $r->opened = 'yes';
                        break;
                    }else{
                        $r->opened = 'no';
                        break;
                    }

                }else{

                    $r->opened = 'no';
                }
            }
        }else{
            $r->opened = 'no';
        }
    }
    $agent = new Agent();
    $agent = $agent->isMobile();
    //dd(DB::getQueryLog());
    if($agent != false){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});

Route::get('search/filter', function() {
    return View::make('search');
});
Route::post('search/filter', 'SearchController@filter');

Route::get('restaurants/request_online_order', function() {
    return View::make('search');
});
Route::post('/restaurants/request_online_order', 'RestaurantsController@request_online_order');



Route::get('/restaurants/next_reviews/{id}', function($id)
    {
        $data['reviews'] = \App\Restaurant_Reviews::where('restaurant_id', '=', $id)->paginate(50);

        return View::make('next_review_box')->with('data', $data);
    }
);

Route::get('category/{category_name}', function($category_name)
{
    $data['location'] = GeoIP::getLocation();
    if($data['location']['country'] == 'United States'){
        $data['search_city'] = $data['location']['city'];
        $data['search_state'] = $data['location']['state'];
    }else{
        $data['search_city'] = 'Phoenix';
        $data['search_state'] = 'AZ';
    }
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->where('city.city', '=', $data['search_city'])
        ->where('state.short', '=', $data['search_state'])
        ->where('categories', 'LIKE', '%'.$category_name.'%')
        ->paginate(10);
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});

Route::get('restaurants/{permalink}', function($permalink)
{
    $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->take(1)->get();
    $agent = new Agent();
    if($agent->isMobile()){
        return View::make('mobile_restaurant')->with('data', $data);
    }else{
        return View::make('restaurant')->with('data', $data);
    }

});


Route::get('voice', function() {
    return View::make('voice');
});
Route::post('voice', 'SearchController@voice');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

