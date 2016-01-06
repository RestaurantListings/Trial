<?php
namespace App\Http\Controllers;
use DB;
use Jenssegers\Agent\Agent;
use GeoIP;
use Session as s;


class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/*
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        DB::connection()->enableQueryLog();
        $data['location'] = GeoIP::getLocation();
        $l_city = $data['location']['city'];
        $l_state = $data['location']['state'];
        $agent = new Agent();

        $get_city = \App\City::where('city', '=', $l_city)->take(1)->get();
        foreach($get_city as $c){
            $city = $c->id;
        }

        $data['recent_restaurants'] = \App\Restaurants::where('having_menu', '=', '1')
            ->where('city_id', '=', $city)
            ->orderBy(DB::raw('RAND()'))
            ->take(4)
            ->get();

        $data['recent_reviews'] = \App\Restaurant_Reviews::where('source', 'LIKE', '%GOOGLE%')->orderBy(DB::raw('RAND()'))
            ->where('restaurants.city_id', '=', $city)
            ->leftJoin('restaurants', 'restaurants_reviews.restaurants_id', '=', 'restaurants.id')
            ->leftJoin('city', 'restaurants.city_id', '=', 'city.id')
            ->leftJoin('state', 'restaurants.state_id', '=', 'state.id')
            ->take(6)
            ->get();
        //$data['nearest_zip'] = \App\Zip::where('zip', '>', (int)session('geoip-locations.postal_code')-10)->where('zip', '<', (int)session('geoip-locations.postal_code')+10)
          //  ->take(5)->get();
        //dd(DB::getQueryLog());

        if($agent->isMobile()){
            return view('mobile_home')->with($data);
        }else{
            return view('home')->with($data);
        }


    }

}
