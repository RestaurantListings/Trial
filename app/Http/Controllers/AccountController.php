<?php namespace App\Http\Controllers;

use Input;
use Request;
use App\User;
use DB;
use Validator;
use Auth;

class AccountController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Account Controller
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

    public function doYouHaveRegister(){
        $data['first-name'] = Input::get('first-name');
        $data['last-name'] = Input::get('last-name');
        $data['phone-no'] = Input::get('phone-no');
        $data['email'] = Input::get('email-address');
        $data['password'] = 'password';

        $data['validation'] = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if(Input::get('cholesterol') != null){ $data['cholesterol'] = 1; }else{ $data['cholesterol'] = 0; }
        if(Input::get('diabetic') != null) { $data['diabetic'] = 1; }else{ $data['diabetic'] = 0; }
        if(Input::get('hbp') != null) { $data['hbp'] = 1; }else{ $data['hbp'] = 0; }
        if(Input::get('weightloss')!= null) { $data['weightloss'] = 1; }else{ $data['weightloss'] = 0; }

        $user = DB::table('users')->where('email', $data['email'])->get();

        if(count($user) == 0){
            $data['new_user'] = User::create([
                'name' => $data['first-name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            DB::table('user_details')->insert(
                [
                    'user_id' => $data['new_user']->id,
                    'first_name' => $data['first-name'],
                    'last_name' => $data['last-name'],
                    'phone_no' => $data['phone-no']
                ]
            );
            DB::table('user_health')->insert(
                [
                    'user_id' => $data['new_user']->id,
                    'cholesterol' => $data['cholesterol'],
                    'diabetic' => $data['diabetic'],
                    'high_blood_pressure' => $data['hbp'],
                    'weight_loss' => $data['weightloss']
                ]
            );
            $data['user_id'] = $data['new_user']->id;
        }else{
            $healthy = DB::table('user_health')->where('user_id', $user[0]->id)->get();
            if(count($healthy) == 0){
                DB::table('user_health')->insert(
                    [
                        'user_id' => $data['new_user']->id,
                        'cholesterol' => $data['cholesterol'],
                        'diabetic' => $data['diabetic'],
                        'high_blood_pressure' => $data['hbp'],
                        'weight_loss' => $data['weightloss']
                    ]
                );
            }else{
                DB::table('user_health')->where('user_id', $user[0]->id)->update(
                    [
                        'cholesterol' => $data['cholesterol'],
                        'diabetic' => $data['diabetic'],
                        'high_blood_pressure' => $data['hbp'],
                        'weight_loss' => $data['weightloss']
                    ]
                );
            }
            $data['user_id'] = $user[0]->id;
        }
        Auth::loginUsingId($data['user_id']);
    }

}
