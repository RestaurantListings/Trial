<?php namespace App\Http\Controllers;

use Input;
use Request;
use App\User;
use DB;
use Validator;
use Auth;

class SuggestionsController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Suggestions Controller
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

    public function cholesterolMeals(){

        //DB::connection()->enableQueryLog();
        $cholesterol = Input::get('cholesterol-level');
        $weight = Input::get('body-weight');
        $weight_type = Input::get('weight-type');
        $height = Input::get('body-height');
        $height_type = Input::get('height-type');

        if($height_type == 'cms'){
            /*Convert cms to ft*/
            $height = $height * 0.032808;
            $height = explode('.', $height);
            $height = "0.".$height[1];
            $inch = (float)$height * 12;
        }else{
            $height = explode('.', $height);
            $height = "0.".$height[1];
            $inch = (float)$height * 12;
        }
        $ibw = 52 + ((float)$inch * (float)1.9);
        $daily_calorie = $ibw * 25;
        $twenty_percent_calorie_per_meal = ($daily_calorie/3)*0.2;

        if($cholesterol < 150){
            $data['menu'] = DB::table('restaurants_menu')->where('restaurants_id', '=', Input::get('rid'))->take(5)->get();
        }elseif($cholesterol > 150 && $cholesterol < 200){
            $data['menu'] = DB::table('restaurants_menu')->where('restaurants_id', '=', Input::get('rid'))->where('product_cholesterol', '<', '100')->where('product_calories', '<', $twenty_percent_calorie_per_meal)->take(5)->get();
        }elseif($cholesterol > 200 && $cholesterol < 240){
            $data['menu'] = DB::table('restaurants_menu')->where('restaurants_id', '=', Input::get('rid'))->where('product_cholesterol', '<', '100')->where('product_calories', '<', $twenty_percent_calorie_per_meal)->take(5)->get();
        }else{
            $data['menu'] = DB::table('restaurants_menu')->where('restaurants_id', '=', Input::get('rid'))->where('product_cholesterol', '<', '60')->where('product_calories', '<', $twenty_percent_calorie_per_meal)->take(5)->get();
        }

        $content = '<div class="panel panel-default panel-updated-menu">'
                    .'<div class="panel-heading">Suggestive Meals for Cholesterol</div>';
        if(count($data['menu']) == 0){
            $content .='<div class="panel-body"><p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don&apos;t have food suggestions fot this restaurant. '
                        .'<button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal" style="float:right;">
                Alert Me When Available
            </button> <br/>There are 25 other healthy food suggestions in your area.</em>
                </p></div>';
        }else{
        foreach($data['menu'] as $m){
            $content .='<div class="panel-body">'
                            .'<h5>'.$m->product_name.'</h5>'
                                .'<table class="table table-stripped">'
                                    .'<tbody>'
                                        .'<tr>'
                                            .'<th>Calories</th>'
                                            .'<th>Fat</th>'
                                            .'<th>Sodium</th>'
                                            .'<th>Carbs</th>'
                                        .'</tr>'
                                        .'<tr>'
                                            .'<td>'.$m->product_calories.'</td>'
                                            .'<td>'.$m->product_total_fat.' gms</td>'
                                            .'<td>'.$m->product_sodium.' mgs</td>'
                                            .'<td>'.$m->product_carbohydrates.' gms</td>'
                                        .'</tr>'
                                    .'</tbody>'
                                .'</table>'
                            .'</div>';
        }
        }
        $content .= '</div>';

        return $content;

    }
    public function highBPMeals(){

        $highbp = Input::get('highbp-level');
        $weight = Input::get('body-weight');
        $weight_type = Input::get('weight-type');
        $height = Input::get('body-height');
        $height_type = Input::get('height-type');

        if($height_type == 'cms'){
            /*Convert cms to ft*/
            $height = $height * 0.032808;
            $height = explode('.', $height);
            $height = "0.".$height[1];
            $inch = (float)$height * 12;
        }else{
            $height = explode('.', $height);
            $height = "0.".$height[1];
            $inch = (float)$height * 12;
        }
        $ibw = 52 + ((float)$inch * (float)1.9);
        $daily_calorie = $ibw * 25;
        $twenty_percent_calorie_per_meal = ($daily_calorie/3)*0.2;
        $calorie_low = $twenty_percent_calorie_per_meal - 25;
        $calorie_high = $twenty_percent_calorie_per_meal + 25;

        $data['menu'] = DB::table('restaurants_menu')
            ->where('restaurants_id', '=', Input::get('rid'))
            ->where(function($query) use($calorie_low, $calorie_high){
                $query->where('product_calories', '>', $calorie_low)
                    ->orWhere('product_calories', '<', $calorie_high);
            })
            ->where(function($query2){
                $query2->where('product_sodium', '>', '390')
                    ->orWhere('product_sodium', '<', '410');
            })
            ->where(function($query3){
                $query3->where('product_cholesterol', '>', '90')
                    ->orWhere('product_cholesterol', '<', '110');
            })
            ->take(5)
            ->get();

        $content = '<div class="panel panel-default panel-updated-menu">'
            .'<div class="panel-heading">Suggestive Meals for High Blood Pressure</div>';
        if(count($data['menu']) == 0){
            $content .='<div class="panel-body"><p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don&apos;t have food suggestions fot this restaurant. '
                .'<button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal" style="float:right;">
                Alert Me When Available
            </button> <br/>There are 25 other healthy food suggestions in your area.</em>
                </p></div>';
        }else{
        foreach($data['menu'] as $m){
            $content .='<div class="panel-body">'
                .'<h5>'.$m->product_name.'</h5>'
                .'<table class="table table-stripped">'
                .'<tbody>'
                .'<tr>'
                .'<th>Calories</th>'
                .'<th>Fat</th>'
                .'<th>Sodium</th>'
                .'<th>Carbs</th>'
                .'</tr>'
                .'<tr>'
                .'<td>'.$m->product_calories.'</td>'
                .'<td>'.$m->product_total_fat.' gms</td>'
                .'<td>'.$m->product_sodium.' mgs</td>'
                .'<td>'.$m->product_carbohydrates.' gms</td>'
                .'</tr>'
                .'</tbody>'
                .'</table>'
                .'</div>';
        }
        }
        $content .= '</div>';

        return $content;

    }

    public function diabeticMeals(){

        $diabetic_high_bp = Input::get('diabetic_high_bp');
        $weight = Input::get('body-weight');
        $weight_type = Input::get('weight-type');
        $height = Input::get('body-height');
        $height_type = Input::get('height-type');

        if($height_type == 'cms'){
            /*Convert cms to ft*/
            $height = $height * 0.032808;
            $height = explode('.', $height);
            $height = "0.".$height[1];
            $inch = (float)$height * 12;
        }else{
            $height = explode('.', $height);
            $height = "0.".$height[1];
            $inch = (float)$height * 12;
        }
        $ibw = 52 + ((float)$inch * (float)1.9);
        $daily_calorie = $ibw * 25;
        $twenty_percent_calorie_per_meal = ($daily_calorie/3)*0.2;
        $fifty_percent_calorie_per_meal = ($daily_calorie/3)*0.5;
        $calorie_low = $twenty_percent_calorie_per_meal - 25;
        $calorie_high = $twenty_percent_calorie_per_meal + 25;
        $carbohydrate_low = $fifty_percent_calorie_per_meal - 50;
        $carbohydrate_high = $fifty_percent_calorie_per_meal + 50;

        if($diabetic_high_bp == 1){
            $sodium = 1500;
        }else{
            $sodium = 1200;
        }
        $data['menu'] = DB::table('restaurants_menu')
            ->where('restaurants_id', '=', Input::get('rid'))
            ->where('product_calories', '<', $daily_calorie/3)
            ->where('product_sodium', '<', $sodium)
            ->where(function($query2) use($calorie_low, $calorie_high){
                $query2->where('product_total_fat', '>', $calorie_low)
                    ->orWhere('product_total_fat', '<', $calorie_high);
            })
            ->where(function($query3) use($carbohydrate_low, $carbohydrate_high){
                $query3->where('product_cholesterol', '>', $carbohydrate_low)
                    ->orWhere('product_cholesterol', '<', $carbohydrate_high);
            })
            ->take(5)
            ->get();

        $content = '<div class="panel panel-default panel-updated-menu">'
            .'<div class="panel-heading">Suggestive Meals for Diabetic</div>';
        if(count($data['menu']) == 0){
            $content .='<div class="panel-body"><p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don&apos;t have food suggestions fot this restaurant. '
                .'<button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal" style="float:right;">
                Alert Me When Available
            </button> <br/>There are 25 other healthy food suggestions in your area.</em>
                </p></div>';
        }else{
            foreach($data['menu'] as $m){
                $content .='<div class="panel-body">'
                    .'<h5>'.$m->product_name.'</h5>'
                    .'<table class="table table-stripped">'
                    .'<tbody>'
                    .'<tr>'
                    .'<th>Calories</th>'
                    .'<th>Fat</th>'
                    .'<th>Sodium</th>'
                    .'<th>Carbs</th>'
                    .'</tr>'
                    .'<tr>'
                    .'<td>'.$m->product_calories.'</td>'
                    .'<td>'.$m->product_total_fat.' gms</td>'
                    .'<td>'.$m->product_sodium.' mgs</td>'
                    .'<td>'.$m->product_carbohydrates.' gms</td>'
                    .'</tr>'
                    .'</tbody>'
                    .'</table>'
                    .'</div>';
            }
        }
        $content .= '</div>';

        return $content;

    }

    public function weightLossMeals(){

        /*Gather all user data */
        $age = Input::get('age');
        $gender = Input::get('gender');
        $current_weight = Input::get('body-weight-lbs');
        $height_ft = Input::get('body-height-ft');
        $height_in = Input::get('body-height-in');
        $activity = Input::get('activity');
        $weight_to_achieve = Input::get('weight-to-achieve');
        $month_to_achieve = Input::get('month-to-achieve');
        $date_to_achieve = Input::get('date-to-achieve');
        $year_to_achieve = Input::get('year-to-achieve');
        $today = date('m/j/Y');
        $current_date = strtotime($today);
        /*Convert height in ft-in to in */
        $height_inch = ($height_ft * 12) + $height_in;

        $data['alert_message'] = '';

        /*Calculate BMR based on the gender*/
        if($gender == 'm'){
            $bmr = 66 + (6.3 * $current_weight) + (12.9 * $height_inch) - (6.8 * $age);
        }else{
            $bmr = 655 + (4.3 * $current_weight) + (4.7 * $height_inch) - (4.7 * $age);
        }

        /*Calculate Total required calorie based on daily activity = BMR x Activity*/
        $current_calorie = $bmr + ($bmr * $activity);

        /*Calculate no. of days for the achievement*/
        $date_to_achieve = strtotime($month_to_achieve.'/'.$date_to_achieve.'/'.$year_to_achieve);
        if($date_to_achieve > $current_date){
            $number_days = ($date_to_achieve - $current_date) / (60 * 60 * 24);
        }else{
            $number_days = 1;
        }
        echo '<script>console.log("'.$number_days.'");</script>';

        //Check whether to loose or gain weight and calculate the total calorie change required for gain or loose weight
        if($weight_to_achieve > $current_weight){
            $goal = 'gain';
            $difference_weight = $weight_to_achieve - $current_weight;
            $calorie_change_needed = $difference_weight * 3500;
        }else{
            $goal = 'loose';
            $difference_weight = $current_weight - $weight_to_achieve;
            $calorie_change_needed = $difference_weight * 3500;
        }

        //Caluclate amount of calories required per day for the change
        $calorie_change_per_day = $calorie_change_needed / $number_days;
        echo '<script>console.log("'.$calorie_change_per_day.'");</script>';

        //Check the weekly change in pounds
        $weekly_change_calorie = $calorie_change_per_day * 7;
        if($activity == '0.2' || $activity == '0.375'){
            if($weekly_change_calorie > 7000){
                $calorie_change_per_day = 1000;
            }
        }else{
            if($weekly_change_calorie > 3500){
                $calorie_change_per_day = 500;
            }
        }

        if($goal == 'gain'){
            $new_calorie = $current_calorie + $calorie_change_per_day;
        }else{
            $new_calorie = $current_calorie - $calorie_change_per_day;
            if($gender == 'm'){
                if($new_calorie < 1500){
                    $data['alert_message'] = 'Your goal is too aggressive which is bad for health. We have set the goal date accordingly so that you loose the required weight';
                }
            }else{
                if($new_calorie < 1200){
                    $data['alert_message'] = 'Your goal is too aggressive which is bad for health. We have set the goal day accordingly so that you loose the required weight';
                }
            }
        }
        $number_days_adjusted = round($calorie_change_needed / $calorie_change_per_day);

        $data['goal_weight'] = $weight_to_achieve;
        if($number_days_adjusted != null){
            $date_to_achieve = ($number_days * 60 * 60 * 24) + $current_date;
            $data['goal_date'] = date('F j, Y', $date_to_achieve);
        }else{
            $data['goal_date'] = date('F j, Y', $month_to_achieve.'/'.$date_to_achieve.'/'.$year_to_achieve);
        }

        $inch = $height_in;
        $inches = $height_inch;
        $weight = $current_weight;

        /* Step 1: Multiply LBS with 0.45 */
        $step_one = $weight * 0.45;
        /* Step 2: Multiply Inches with 0.025 */
        $step_two = $inches * 0.025;
        /* Step 3: Square the Step 2 answer */
        $step_three = $step_two * $step_two;
        /* Step 4: Divide Step 1 answer with Step 3 answer */
        $step_four = $step_one / $step_three;

        if($step_four < 18.5){
            $case = 1;
        }elseif($step_four > 18.5 && $step_four < 24.9){
            $case = 2;
        }elseif($step_four > 25 && $step_four < 29.9){
            $case = 3;
        }elseif($step_four > 30 && $step_four < 34.9){
            $case = 4;
        }elseif($step_four > 35 && $step_four < 39.9){
            $case = 5;
        }else{
            $case = 6;
        }

        $ibw = 52 + ((float)$inch * (float)1.9);
        $daily_calorie = $ibw * 25;
        $twenty_percent_calorie_per_meal = ($daily_calorie/3)*0.2;
        $fifty_percent_calorie_per_meal = ($daily_calorie/3)*0.5;
        $fat_low = $twenty_percent_calorie_per_meal - 25;
        $fat_high = $twenty_percent_calorie_per_meal + 25;


        switch($case){
            case 1:
                $data['menu'] = DB::table('restaurants_menu')->where('restaurants_id', '=', Input::get('rid'))->take(5)->get();
                break;
            case 2:
                $data['menu'] = DB::table('restaurants_menu')
                    ->where('restaurants_id', '=', Input::get('rid'))
                    ->where('product_calories', '<', $daily_calorie/3)
                    ->where(function($query2) use($fat_low, $fat_high){
                        $query2->where('product_total_fat', '>', $fat_low)
                            ->orWhere('product_total_fat', '<', $fat_high);
                    })
                    ->take(5)
                    ->get();
                break;
            case 3:
                $data['menu'] = DB::table('restaurants_menu')
                    ->where('restaurants_id', '=', Input::get('rid'))
                    ->where('product_calories', '<', $daily_calorie/3)
                    ->where(function($query2) use($fat_low, $fat_high){
                        $query2->where('product_total_fat', '>', $fat_low)
                            ->orWhere('product_total_fat', '<', $fat_high);
                    })
                    ->take(5)
                    ->get();
                break;
            case 4:
                $data['menu'] = DB::table('restaurants_menu')
                    ->where('restaurants_id', '=', Input::get('rid'))
                    ->where('product_calories', '<', $daily_calorie/4)
                    ->where(function($query2) use($fat_low, $fat_high){
                        $query2->where('product_total_fat', '>', $fat_low)
                            ->orWhere('product_total_fat', '<', $fat_high);
                    })
                    ->take(5)
                    ->get();
                break;
            case 5:
                $data['menu'] = DB::table('restaurants_menu')
                    ->where('restaurants_id', '=', Input::get('rid'))
                    ->where('product_calories', '<', $daily_calorie/5)
                    ->where(function($query2) use($fat_low, $fat_high){
                        $query2->where('product_total_fat', '>', $fat_low)
                            ->orWhere('product_total_fat', '<', $fat_high);
                    })
                    ->take(5)
                    ->get();
                break;
            case 6:
                $data['menu'] = DB::table('restaurants_menu')
                    ->where('restaurants_id', '=', Input::get('rid'))
                    ->where('product_calories', '<', $daily_calorie/6)
                    ->where(function($query2) use($fat_low, $fat_high){
                        $query2->where('product_total_fat', '>', $fat_low)
                            ->orWhere('product_total_fat', '<', $fat_high);
                    })
                    ->take(5)
                    ->get();
                break;
        }

        $content = '<div class="panel panel-default panel-updated-menu">'
            .'<div class="panel-heading">Suggestive Meals for Weight Loss</div>
            <div class="panel-body">
                <div class="calculation-result">
                    <p>Your BMR is: <b>'.round($bmr).' calories/day</b>. You need <b>'.round($current_calorie).' calories per day</b> to maintain the current weight.</p>
                    <p class="alert-red">'.$data['alert_message'].'</p>
                    <p>You should consume about <b>'.round($new_calorie).' calories</b> a day to reach your goal weight of <b>'.$data['goal_weight'].' lbs</b> by <b>'.$data['goal_date'].'</b></p>
                </div>
            </div>';

        if(count($data['menu']) == 0){
            $content .='<div class="panel-body">
                <div class="calculation-result">
                <p>Your BMR is: <b>'.round($bmr).' calories/day</b>. You need <b>'.round($current_calorie).' calories per day</b> to maintain the current weight.</p>
                <p class="alert-red">'.$data['alert_message'].'</p>
                <p>You should consume about <b>'.round($new_calorie).' calories</b> a day to reach your goal weight of <b>'.$data['goal_weight'].' lbs</b> by <b>'.$data['goal_date'].'</b></p>
            </div>
                <p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don&apos;t have food suggestions fot this restaurant. '
                .'<button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal" style="float:right;">
                        Alert Me When Available
                    </button> <br/>There are 25 other healthy food suggestions in your area.</em>
                        </p></div>';
        }else{
            foreach($data['menu'] as $m){
                $content .='<div class="panel-body">'
                  .'<h5>'.$m->product_name.'<span class="favorite-icon" data-toggle="tooltip" data-placement="top" title="Add to Favorites"></span></h5>'
                    .'<table class="table table-stripped">'
                    .'<tbody>'
                    .'<tr>'
                    .'<th>Calories</th>'
                    .'<th>Fat</th>'
                    .'<th>Sodium</th>'
                    .'<th>Carbs</th>'
                    .'</tr>'
                    .'<tr>'
                    .'<td>'.$m->product_calories.'</td>'
                    .'<td>'.$m->product_total_fat.' gms</td>'
                    .'<td>'.$m->product_sodium.' mgs</td>'
                    .'<td>'.$m->product_carbohydrates.' gms</td>'
                    .'</tr>'
                    .'</tbody>'
                    .'</table>'
                    .'</div>';
            }
        }
        $content .= '</div>';

        return $content;
    }


}
