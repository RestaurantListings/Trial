<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/13/15
 * Time: 11:40 PM
 */
 namespace App\Http\Controllers;
 //use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Request;
 use App\Http\Requests;
 use Input;
 use Jenssegers\Agent\Agent;
 use DB;


 class SearchController extends Controller {

     public function voice() {
         $data = Input::all();
         ////$results = \App\Restaurants::getSearchDetail($data['q']);

         $recent = \App\Restaurants::where('name', 'like', $data['q'])->take(10)->get();
         print_r($recent);
         return \View::make('search')->with('recent', $recent);

         //DB::table('users')->where('votes', '>', 100)->get();

     }
     public function homeSearch()
     {
         DB::connection()->enableQueryLog();
         $user_config=array('keywords'=>\Input::get('keywords'),'location'=>\Input::get('location'));
         $ltype='';
         if(!is_numeric($user_config['location'])){
             if(strpos($user_config['location'], ',') === false){
                 $data['location'] = $user_config['location'];
                 $ltype = 'city';
             }else{
                 $loc = explode(', ', $user_config['location']);
                 $data['search_city'] = $loc[0];
                 $data['search_state'] = $loc[1];
                 $data['location'] = $data['search_city'].', '.$data['search_state'];
                 $ltype = 'default';
             }

         }else{
             //Assign zip code to the data
             $data['location'] = $user_config['location'];
             $ltype = 'zip';
         }
         //Get the filter options matching the location
         $data['filter_options']['city'] = \App\City::take(5)->get();
         if(count(Input::get()) == 3){
             if($ltype == 'default'){
                $search_type = 'default';
             }elseif($ltype == 'city'){
                $search_type = 'default_city';
             }else{
                $search_type = 'default_zip';
             }
         }else{
             if($ltype == 'default'){
                 $search_type = 'filter';
             }elseif($ltype == 'city'){
                 $search_type = 'filter_city';
             }else{
                 $search_type = 'filter_zip';
             }

         }

         //echo $search_type;
         //dd(Input::get());

         switch($search_type){
             case 'default':
                 $data['restaurants'] = \App\Restaurants::join('city', 'city.id', '=', 'restaurants.city_id')
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
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$loc[0].', '.$loc[1].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$loc[0].', '.$loc[1].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $loc[0].', '.$loc[1].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>$loc[0], "search_state"=>$loc[1], "search_zip"=>""]);
                 break;
             case 'default_city':
                 $data['restaurants'] = \App\Restaurants::join('city', 'city.id', '=', 'restaurants.city_id')
                     ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
                     ->where(function($query) use($user_config){
                         $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                             ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

                     })
                     ->where('city.city', '=', $data['location'])
                     ->orderBy('restaurants.rank', 'desc')
                     ->orderBy('restaurants.categories', 'asc')
                     ->paginate(10);
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$data['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$data['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $data['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>$data['location'], "search_state"=>"", "search_zip"=>""]);
                 break;
             case 'default_zip':
                 //Get restaurants matching the keywords and the location
                 $data['restaurants'] = \App\Restaurants::join('city', 'city.id', '=', 'restaurants.city_id')
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
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$user_config['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$user_config['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $user_config['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>"", "search_state"=>"", "search_zip"=>$user_config['location']]);
                 break;

             case 'filter':
                 $data['restaurants'] = \App\Restaurants::join('city', 'city.id', '=', 'restaurants.city_id')
                     ->join('state', 'state.id', '=', 'restaurants.state_id')
                     ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
                     ->where(function($query) use($user_config){
                         $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                             ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

                     })
                     ->where('city.city', '=', $loc[0])
                     ->where('state.short', '=', $loc[1])
                     ->where(function($query){
                         $category = Input::has('category') ? Input::get('category') : NULL;
                         if(isset($category)){
                             foreach($category as $c){
                                 $query->orWhere('restaurants.categories', 'LIKE', '%'.$c.'%');
                             }
                         }
                         $ordering = Input::has('ordering') ? Input::get('ordering') : NULL;
                         if(isset($ordering)){
                             foreach($ordering as $o){
                                 $query->where('restaurants_info.more_info', 'LIKE', '%'.$o.'%');
                             }
                         }
                         $features = Input::has('features') ? Input::get('features') : NULL;
                         if(isset($features)){
                             foreach($features as $f){
                                 $query->where('restaurants_info.more_info', 'LIKE', '%'.$f.'%');
                             }
                         }
                         $reservation = Input::has('reservation') ? 'Takes Reservations  --> Yes' : NULL;
                         if(isset($reservation)){
                            $query->where('restaurants_info.more_info', 'LIKE', '%'.$reservation.'%');
                         }

                         $price_1 = Input::has('price_1') ? '$' : NULL;
                         $price_2 = Input::has('price_2') ? '$$' : NULL;
                         $price_3 = Input::has('price_3') ? '$$$' : NULL;
                         $price_4 = Input::has('price_4') ? '$$$$' : NULL;
                         if(isset($price_1) || isset($price_2) || isset($price_3) || isset($price_4)){
                             $query->where(function($query) use ($price_1, $price_2, $price_3, $price_4){
                                 $query->where('restaurants_info.price_range', '=', $price_1)
                                     ->orWhere('restaurants_info.price_range', '=', $price_2)
                                     ->orWhere('restaurants_info.price_range', '=', $price_3)
                                     ->orWhere('restaurants_info.price_range', '=', $price_4);

                             });

                         }


                     })
                     ->orderBy('restaurants.rank', 'desc')
                     ->orderBy('restaurants.categories', 'asc')
                     ->paginate(10);
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$loc[0].', '.$loc[1].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$loc[0].', '.$loc[1].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $loc[0].', '.$loc[1].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>$loc[0], "search_state"=>$loc[1], "search_zip"=>""]);
                 break;
             case 'filter_city':
                 $data['restaurants'] = \App\Restaurants::join('city', 'city.id', '=', 'restaurants.city_id')
                     ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
                     ->where(function($query) use($user_config){
                         $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                             ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

                     })
                     ->where('city.city', '=', $data['location'])
                     ->where(function($query){
                         $category = Input::has('category') ? Input::get('category') : NULL;
                         $reservation = Input::has('reservation') ? 'Takes Reservations  --> Yes' : NULL;
                         if(isset($category)){
                             foreach($category as $c){
                                 $query->orWhere('restaurants.categories', 'LIKE', '%'.$c.'%');
                             }
                         }
                         if(isset($reservation)){
                             $query->where('restaurants_info.more_info', 'LIKE', '%'.$reservation.'%');
                         }
                         $price_1 = Input::has('price_1') ? '$' : NULL;
                         $price_2 = Input::has('price_2') ? '$$' : NULL;
                         $price_3 = Input::has('price_3') ? '$$$' : NULL;
                         $price_4 = Input::has('price_4') ? '$$$$' : NULL;
                         if(isset($price_1) || isset($price_2) || isset($price_3) || isset($price_4)){
                             $query->where(function($query) use ($price_1, $price_2, $price_3, $price_4){
                                 $query->where('restaurants_info.price_range', '=', $price_1)
                                     ->orWhere('restaurants_info.price_range', '=', $price_2)
                                     ->orWhere('restaurants_info.price_range', '=', $price_3)
                                     ->orWhere('restaurants_info.price_range', '=', $price_4);

                             });

                         }
                     })
                     ->orderBy('restaurants.rank', 'desc')
                     ->orderBy('restaurants.categories', 'asc')
                     ->paginate(10);
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$data['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$data['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $data['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>$data['location'], "search_state"=>"", "search_zip"=>""]);
                 break;
             case 'filter_zip':
                 $data['restaurants'] = \App\Restaurants::join('city', 'city.id', '=', 'restaurants.city_id')
                     ->join('state', 'state.id', '=', 'restaurants.state_id')
                     ->join('restaurants_info', 'restaurants_info.restaurants_id', '=', 'restaurants.id')
                     ->where(function($query) use($user_config){
                         $query->where('restaurants.name', 'LIKE', '%'.$user_config['keywords'].'%')
                             ->orWhere('restaurants.categories', 'LIKE', '%'.$user_config['keywords'].'%');

                     })
                     ->where('restaurants.zip', 'LIKE', $user_config['location'])
                     ->where(function($query){
                         $category = Input::has('category') ? Input::get('category') : NULL;
                         $reservation = Input::has('reservation') ? 'Takes Reservations  --> Yes' : NULL;

                         if(isset($category)){
                             foreach($category as $c){
                                 $query->orWhere('restaurants.categories', 'LIKE', '%'.$c.'%');
                             }
                         }
                         if(isset($reservation)){
                             $query->where('restaurants_info.more_info', 'LIKE', '%'.$reservation.'%');
                         }
                         $price_1 = Input::has('price_1') ? '$' : NULL;
                         $price_2 = Input::has('price_2') ? '$$' : NULL;
                         $price_3 = Input::has('price_3') ? '$$$' : NULL;
                         $price_4 = Input::has('price_4') ? '$$$$' : NULL;
                         if(isset($price_1) || isset($price_2) || isset($price_3) || isset($price_4)){
                             $query->where(function($query) use ($price_1, $price_2, $price_3, $price_4){
                                 $query->where('restaurants_info.price_range', '=', $price_1)
                                     ->orWhere('restaurants_info.price_range', '=', $price_2)
                                     ->orWhere('restaurants_info.price_range', '=', $price_3)
                                     ->orWhere('restaurants_info.price_range', '=', $price_4);

                             });

                         }

                     })
                     ->orderBy('restaurants.rank', 'desc')
                     ->orderBy('restaurants.categories', 'asc')
                     ->paginate(10);
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$user_config['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$user_config['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $user_config['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>"", "search_state"=>"", "search_zip"=>$user_config['location']]);
                 break;

         }
         $data['cuisine'] = DB::table('categories')->get();
         foreach($data['restaurants'] as $r){
         /*    if($r->hours !!= ''){
                 $hours = explode('||', $r->hours);

                 foreach($hours as $h)
                 {
                     $ho = explode(' -->', $h);

                     if((date('D') == str_replace(' ', '',$ho[0])) && (strpos($ho[1], 'Closed') === false)){
                         if(strpos($ho[1], 'Open 24 hours') === false){
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
                             $r->opened = 'yes';
                         }
                     }else{
                         $r->opened = 'no';
                     }
                 }
             }else{
                 $r->opened = 'no';
             }*/
             $r->opened = 'yes';
         }

         $agent = new Agent();
         $agent = $agent->isMobile();
         //dd($data);
         //dd(DB::getQueryLog());
         if($agent != false){
             return \View::make('mobile_search')->with($data);
         }else{
             return \View::make('search')->with($data);
         }
     }

     public function bannerSearch(){
         DB::connection()->enableQueryLog();
         $user_config=array('keywords'=>\Input::get('keywords'),'location'=>\Input::get('location'));
         if(!is_numeric($user_config['location'])){
             if((strpos($user_config['location'], ",") === false) && ($user_config['location'] != 'Current Location')){
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
                 /*foreach($data['restaurants'] as $rest){
                     $rest['reviews'] = $this->getReviewsThree($rest->permalink);
                 }*/
                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$data['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$data['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $data['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';

                 session(["search_city"=>$data['location'], "search_state"=>"", "search_zip"=>""]);

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

                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$data['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$data['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $data['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>$loc[0], "search_state"=>$loc[1], "search_zip"=>""]);
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

                 $data['meta_title'] = 'Find the Best '.$user_config['keywords'].' Restaurants in '.$data['location'].' | Restaurant Listings|';
                 $data['meta_description'] = $user_config['keywords'].' in '.$data['location'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 $data['meta_keywords'] = $data['location'].', '.$user_config['keywords'].' Online food Order, Get Menu, Reviews, Contact, Location Maps, Directions';
                 session(["search_city"=>"", "search_state"=>"", "search_zip"=>$user_config['location']]);


         }


         $data['cuisine'] = DB::table('categories')->get();
         //dd($data);
         foreach($data['restaurants'] as $r){
             /*
             if($r->hours != ''){
                 $hours = explode('||', $r->hours);
                 foreach($hours as $h)
                 {
                     $ho = explode(' -->', $h);
                     if((date('D') == str_replace(' ', '',$ho[0])) && ($ho[1] == 'Closed')){
                         $r->id = $r->restaurants_id;
                         $td_hours = explode('-', $ho[1]);
                         if($td_hours[0] == 'Closed'){
                             $r->opened = 'no';
                             break;
                         }else{
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

                         }

                     }else{

                         $r->opened = 'no';
                     }
                 }
             }else{
                 $r->opened = 'no';
             }*/
             $r->opened = 'yes';
         }

         $agent = new Agent();
         $agent = $agent->isMobile();
          //dd(DB::getQueryLog());
         if($agent != false){
             return \View::make('mobile_search')->with($data);
         }else{
             return \View::make('search')->with($data);
         }
     }

     public function autocomplete(){

         $data = \Input::get();
         echo '<script>alert("'.var_dump($data).'")</script>';
     }


     /*
     |--------------------------------------------------------------------------
     | Search Controller
     |--------------------------------------------------------------------------
     |
     | This controller renders your application's search methods.
     |
     */

     /*
     * Get Reviews for each restaurant.
     *
     * @return Response
     */
     public function getReviewsThree($id)
     {
         $reviews = DB::table('restaurants_reviews')->where("restaurants_id", "=", $id)->take(3)->get();
         return $reviews;
     }

 }
