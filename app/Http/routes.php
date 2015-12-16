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
use Session as S;




Route::get('/', 'WelcomeController@index');
Route::get('/landing', function(){
    return View::make('landing');
});
Route::get('/landing_with_menu', function(){
    return View::make('landing_menu');
});

Route::get('home', 'HomeController@index');
Route::post('search/autocomplete', array('as'=>'search', 'uses'=>'SearchController@autocomplete'));
Route::post('/search', array('as'=>'search', 'uses'=>'SearchController@homeSearch'));
Route::get('/search', array('as'=>'search', 'uses'=>'SearchController@bannerSearch'));

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
Route::post('restaurants/request_online_ordering', array('as'=>'request_online_ordering', 'uses'=>function(){
        $data['avail'] = \App\User_Request_Demo::where('email', '=', Input::get('guest_email'))->where('restaurants_id', '=', Input::get('r_id'))->get();
        if(count($data['avail']) == 0){
            $re = DB::table('user_request_demo')->insert(
                ['restaurants_id'=>Input::get('r_id'),'first_name'=> Input::get('guest_first_name'), 'last_name' => Input::get('guest_last_name'), 'email' => Input::get('guest_email'), 'request_type_id' => Input::get('r_t')]
            );

            \App\Restaurants::where('id', '=', Input::get('r_id'))->increment('request_order');
        }else{
            echo '<script>alert("You have already been registered with us. Thank you for your interest");</script>';
        }
        return Redirect::intended('restaurants/'.Input::get('rlink'));
}));
Route::get('10-Best/{category_name}/{city_name}', function($category_name, $city_name)
{

    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $city_name;
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = $city_name;
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $city_name;
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $city_name)
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->take(10)
        ->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());
    $data['meta_title'] = '10 Best '.$category_name.' Restaurants in '.$data['search_city'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $data['search_city'].', '.$category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});

Route::get('10-Best/{category_name}', function($category_name)
{
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $data['locations']['city'];
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = 'Phoenix';
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $data['search_city'].', '.$data['search_state'];
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $data['search_city'])
        ->where('state.short', '=', $data['search_state'])
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->take(10)->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());

    $data['meta_title'] = '10 Best '.$category_name.' Restaurants in '.$data['search_city'].', '.$data['search_state'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});
Route::get('20-Best/{category_name}/{city_name}', function($category_name, $city_name)
{
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $city_name;
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = $city_name;
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $city_name;
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $city_name)
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->take(20)
        ->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());
    $data['meta_title'] = '20 Best '.$category_name.' Restaurants in '.$data['search_city'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $data['search_city'].', '.$category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});

Route::get('20-Best/{category_name}', function($category_name)
{
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $data['locations']['city'];
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = 'Phoenix';
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $data['search_city'].', '.$data['search_state'];
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $data['search_city'])
        ->where('state.short', '=', $data['search_state'])
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->take(20)->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());

    $data['meta_title'] = '20 Best '.$category_name.' Restaurants in '.$data['search_city'].', '.$data['search_state'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});
Route::get('30-Best/{category_name}/{city_name}', function($category_name, $city_name)
{
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $city_name;
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = $city_name;
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $city_name;
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $city_name)
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->take(30)
        ->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());
    $data['meta_title'] = '30 Best '.$category_name.' Restaurants in '.$data['search_city'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $data['search_city'].', '.$category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});

Route::get('30-Best/{category_name}', function($category_name)
{
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $data['locations']['city'];
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = 'Phoenix';
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $data['search_city'].', '.$data['search_state'];
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $data['search_city'])
        ->where('state.short', '=', $data['search_state'])
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->take(30)->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());

    $data['meta_title'] = '30 Best '.$category_name.' Restaurants in '.$data['search_city'].', '.$data['search_state'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});
Route::get('category/{category_name}/{city_name}', function($category_name, $city_name)
{
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        if(!is_numeric($city_name)){
            $data['search_city'] = $city_name;
            $data['search_state'] = $data['locations']['state'];
        }else{
            $data['search_zip'] = $city_name;
            $data['search_city'] = '';
            $data['search_state'] = $data['locations']['state'];
        }
    }else{
        $data['search_city'] = $city_name;
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $city_name;
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    if(!is_numeric($city_name)){
        $data['restaurants'] = DB::table('restaurants')
            ->join('city', 'city.id', '=', 'restaurants.city_id')
            ->join('state', 'state.id', '=', 'restaurants.state_id')
            ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
            ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
            ->where('city.city', '=', $city_name)
            ->orderBy('restaurants.rank', 'desc')
            ->orderBy('restaurants.categories', 'asc')
            ->paginate(10);
    }else{
        $data['restaurants'] = DB::table('restaurants')
            ->join('city', 'city.id', '=', 'restaurants.city_id')
            ->join('state', 'state.id', '=', 'restaurants.state_id')
            ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
            ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
            ->where('restaurants.zip', '=', $city_name)
            ->orderBy('restaurants.rank', 'desc')
            ->orderBy('restaurants.categories', 'asc')
            ->paginate(10);
    }

    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
    //dd(DB::getQueryLog());
    $data['meta_title'] = 'Find the Best '.$category_name.' Restaurants in '.$city_name.' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $city_name.', '.$category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return \View::make('mobile_search')->with($data);
    }else{
        return \View::make('search')->with($data);
    }
});

Route::get('category/{category_name}', function($category_name)
{
    //dd(Input::get('current_location'));
    DB::connection()->enableQueryLog();
    $data['locations'] = GeoIP::getLocation();
    if($data['locations']['country'] == 'United States'){
        $data['search_city'] = $data['locations']['city'];
        $data['search_state'] = $data['locations']['state'];
    }else{
        $data['search_city'] = 'Phoenix';
        $data['search_state'] = 'AZ';
    }
    $data['location'] = $data['search_city'].', '.$data['search_state'];
    //Get the filter options matching the location
    $data['filter_options']['city'] = DB::table('city')->take(5)->get();

    //Get restaurants matching the keywords and the location
    $data['restaurants'] = DB::table('restaurants')
        ->join('city', 'city.id', '=', 'restaurants.city_id')
        ->join('state', 'state.id', '=', 'restaurants.state_id')
        ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
        ->where('restaurants.categories', 'LIKE', '%'.$category_name.'%')
        ->where('city.city', '=', $data['search_city'])
        ->where('state.short', '=', $data['search_state'])
        ->orderBy('restaurants.rank', 'desc')
        ->orderBy('restaurants.categories', 'asc')
        ->paginate(10);
    $data['cuisine'] = DB::table('categories')->get();
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
    //dd($data);
 //dd(DB::getQueryLog());

    $data['meta_title'] = 'Find the Best '.$category_name.' Restaurants in '.$data['search_city'].', '.$data['search_state'].' | Restaurant Listings|';
    $data['meta_description'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = $category_name.' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
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
    $data['bmr'] = 0;
    $agent = new Agent();
    if($agent->isMobile()){
        return View::make('mobile_restaurant')->with('data', $data);
    }else{
        return View::make('restaurant')->with('data', $data);
    }

});
Route::post('restaurants/{permalink}', function($permalink)
{
    $data['bmr']= 1;
    $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->take(1)->get();
    $agent = new Agent();
    if($agent->isMobile()){
        return View::make('mobile_restaurant')->with('data', $data);
    }else{
        return View::make('restaurant')->with('data', $data);
    }

});
Route::get('get-directions/{permalink}', function($permalink)
{
    $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->take(1)->get();
    $data['user_location'] = Session::get('geoip-location.city').', '.Session::get('geoip-location.state').', '.Session::get('geoip-location.postal_code');

    $agent = new Agent();
    if($agent->isMobile()){
        return View::make('mobile_restaurant_directions')->with('data', $data);
    }else{
        return View::make('restaurant_directions')->with('data', $data);
    }

});

Route::post('write-a-review',  array('as'=>'write-a-review/submit', 'uses'=>'WriteReviewController@submit'));
Route::get('write-a-review', function(){
    $data['meta_title'] = 'Write a Review for the Restaurants | Restaurant Listings|';
    $data['meta_description'] = 'Write a review | Restaurants Review | Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = 'Write A Review, Restaurants Reviews, Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';

    $data['location'] = Session::get('geoip-location.city').', '.Session::get('geoip-location.state');

    $agent = new Agent();
    if($agent->isMobile()){
        return View::make('mobile_write_review')->with($data);
    }else{
        return View::make('write_review')->with($data);
    }
});

Route::post('write-a-review/search', array('as'=>'write-a-review/search', 'uses'=>'WriteReviewController@search'));

Route::get('write-a-review/{permalink}', function($permalink)
{
    $data['restaurant'] = \App\Restaurants::where('permalink', '=', $permalink)->take(1)->get();
    $data['meta_title'] = 'Write a Review for the restaurant | Restaurant Listings|';
    $data['meta_description'] = 'Write a review | Restaurants Review | Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $data['meta_keywords'] = 'Write A Review, Restaurants Reviews, Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
    $agent = new Agent();
    if($agent->isMobile()){
        return View::make('mobile_write_review_landing')->with($data);
    }else{
        return View::make('write_review_landing')->with($data);
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

