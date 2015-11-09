<?php
namespace App\Http\Controllers;
use DB;
use Jenssegers\Agent\Agent;
use GeoIP;


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



        $data['recent_restaurants'] = \App\Restaurants::take(4)->get();


        $data['recent_reviews'] = \App\Restaurant_Reviews::where('source', 'LIKE', '%GOOGLE%')->orderby('id', 'desc')->take(4)->get();

        if($agent->isMobile()){
            return view('mobile_home')->with($data);
        }else{
            return view('home')->with($data);
        }


    }

}
