<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/13/15
 * Time: 11:40 PM
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use Input;
use Jenssegers\Agent\Agent;
use DB;
use Session;
use Redirect;



class WriteReviewController extends Controller {

    public function submit()
    {
        if(Input::get('rating')=='one') $rating = 1;
        if(Input::get('rating')=='two') $rating = 2;
        if(Input::get('rating')=='three') $rating = 3;
        if(Input::get('rating')=='four') $rating = 4;
        if(Input::get('rating')=='five') $rating = 5;
        DB::table('restaurants_reviews')->insert(
            [
                'restaurants_id' => Input::get('rid'),
                'user_id' => 0,
                'text' => 'qwe',
                'review_text' => Input::get('text'),
                'rating' => $rating,
                'source' => 'RL',
                'source_link' => 'RL',
                'updated_at' => '',
                'user_name' => 'Guest',
                'user_location' => Session::get('geoip-location.city').', '.Session::get('geoip-location.state'),
                'spin_status' => 1

            ]
        );
        echo '<script>alert("Thank You for your valuable review");</script>';
        $data['restaurant'] = \App\Restaurants::where('permalink', '=', Input::get('rlink'))->take(1)->get();
        $agent = new Agent();
        if($agent->isMobile()){
            return \View::make('mobile_restaurant')->with('data', $data);
        }else{
            return \View::make('restaurant')->with('data', $data);
        }

    }
    public function search()
    {
        DB::connection()->enableQueryLog();
        $user_config=array('keywords'=>\Input::get('keywords'),'location'=>\Input::get('location'));
        if(!is_numeric($user_config['location'])){
            if(strpos($user_config['location'], ",") === false){
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
            }
            */
            $r->opened = 'yes';
        }

        $agent = new Agent();
        $agent = $agent->isMobile();
        // dd(DB::getQueryLog());
        if($agent != false){
            return \View::make('mobile_write_review')->with($data);
        }else{
            return \View::make('write_review')->with($data);
        }
    }

}