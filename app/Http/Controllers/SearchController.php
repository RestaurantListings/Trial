<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/13/15
 * Time: 11:40 PM
 */
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use App\Http\Requests;
 use App\Restaurants as URestaurants;
 use Input;


 class SearchController extends Controller {


//     function __construct(URestaurants $resturant_repo)
//    {
//      $this->resturant_repo = $restaurant_repo;
//    }

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
         $user_config=array('keywords'=>\Input::get('keywords'),'location'=>\Input::get('location'));
         $recent= \App\Restaurants::normalSearch($user_config);

         //echo '<pre>';
         //var_dump($recent);
         //echo '</pre>';
         if(($user_config['keywords'] != '') && ($user_config['location'] != ''))
         {
             $recent= \App\Restaurants::getSearchDetail($user_config);
//           if($recent  == ''){
//                            return  \ Redirect::route('home_redirect_route')->with('message','No Data Found');
//                        }
             //echo '<pre>';
             //var_dump($recent);
             //echo '</pre>';
             return \View::make('search')->with('recent', $recent);
         }
         return \View::make('search')->with('recent', $recent);
     }

     public function searchRestaurant()
     {
         $user_config=array('name'=>\Input::get('restaurant_name'),'city'=>\Input::get('city_state'));

         $recent= \App\Restaurants::getSearchDetail($user_config);

         return \View::make('search')->with('recent', $recent);
     }

     public function bannerSearch()
     {
         $user_config=array('name'=>\Input::get('restaurant_name'),'city'=>\Input::get('city'),'state'=>\Input::get('state'),'zip'=>\Input::get('zip'));

         if(($user_config['name'] != '') && ($user_config['city'] == '') && ($user_config['state'] == '') && ($user_config['zip'] == ''))
         {
             $recent= \App\Restaurants::getSearchDetail($user_config);
//           if($recent  == ''){
//                            return  \ Redirect::route('home_redirect_route')->with('message','No Data Found');
//                        }
             return \View::make('search')->with('recent', $recent);
         }
         else if(($user_config['name'] == '') && ($user_config['city'] != '') && ($user_config['state'] == '') && ($user_config['zip'] == '')){
             $recent= \App\Restaurants::getDetailBycity($user_config);
//             if($recent  == ''){
//                            return  \ Redirect::route('home_redirect_route')->with('message','No Data Found');
//                        }
             return \View::make('search')->with('recent', $recent);

         }
         else if(($user_config['name'] == '') && ($user_config['city'] == '') && ($user_config['state'] != '') && ($user_config['zip'] == ''))
         {
             $recent= \App\Restaurants::getDetailByState($user_config);
//             if($recent  == ''){
//                            return  \ Redirect::route('home_redirect_route')->with('message','No Data Found');
//                        }
             return \View::make('search')->with('recent', $recent);
         }
         else  if(($user_config['name'] == '') && ($user_config['city'] == '') && ($user_config['state'] == '') && ($user_config['zip'] == ''))
         {
             return  \ Redirect::route('home_redirect_route')->with('message','No Data Found');
         }
         else{
             $recent= \App\Restaurants:: getBannerSearchData($user_config);
//            if($recent  == ''){
//                            return  \ Redirect::route('home_redirect_route')->with('message','No Data Found');
//                        }
             return \View::make('search')->with('recent', $recent);
         }


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
     * Search the restaurants based on the request.
     *F
     * @return Response
     */
     public function search()
     {
         $data = \Input::all();
         return $data;
     }

 }
