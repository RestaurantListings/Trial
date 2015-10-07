<?php namespace App\Http\Controllers;

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
        $recent_restaurants = \App\Restaurants::orderbyraw("RAND()")->take(4)->get();
        $recent_reviews = \App\Restaurant_Reviews::orderby('id', 'desc')->take(4)->get();

        return view('home')->with(array('recent_restaurants' => $recent_restaurants, 'recent_reviews' => $recent_reviews));
    }

}
