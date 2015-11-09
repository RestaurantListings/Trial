<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 8:23 PM
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use Input;

class RestaurantsController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /*
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }

    function request_online_order(){
        if(Request::ajax()) {
            $data = Input::all();
            \App\Restaurants::where('id', '=', $data['id'])->increment('request_order');

        }
    }

}