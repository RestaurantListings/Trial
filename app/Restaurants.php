<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model {

    /*
     * Table name is restaurants
     */
    protected $table = 'restaurants';

    /*
     * Many to Many Relationship
     * A Restaurant belongs to many Categories
     */
    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

    /*
     * One to Many Relationship
     * A Restaurant belongs to a City
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /*
     * One to Many Relationship
     * A Restaurant belongs to a State
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /*
     * One to Many Relationship
     * A Restaurant belongs to a Country
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /*
     * One to Many Relationship
     * A Restaurant has many reviews
     */
    public function restaurant_reviews()
    {
        return $this->hasMany('App\Restaurants_Reviews');
    }


   public static function normalSearch($user_config){
       $recent = \App\Restaurants::where('name', 'like', '%'.$user_config['keywords'].'%')->take(10)->get();
       return $recent;
   }

    public static function getSearchDetail($user_config) {
        $location = explode(', ', $user_config['location']);
        $city_id = \App\City::where('city', 'LIKE', $location[0])->get();
        return($city_id->attributes);
        //$condition = ['name'=>$user_config['keywords'], 'city'=>$user_config['location']];

    }
   /* public static function getSearchDetail($user_config) {
        if (($user_config['name'] != '')) {
            $result_set = Restaurants::where('name', 'LIKE', $user_config['name'] . '%')->get();
            return($result_set);
        }
        if (($user_config['city'] != '')) {
            $result = \App\City::where('city', 'LIKE', $user_config['city'] . '%')->pluck('id');
            $result_set = Restaurants::where('city_id', $result)->get();
            return($result_set);
        }
    }*/

    public static function getDetailByname($user_config) {
        if (($user_config['name'] != '')) {
            $result_set = Restaurants::where('name', 'LIKE', $user_config['name'] . '%')->get();
            return($result_set);
        }
        return false;
    }

    public static function getDetailBycity($user_config) {
        if (($user_config['city'] != '')) {
            $result = \App\City::where('city', 'LIKE', $user_config['city'] . '%')->pluck('id');
            $result_set = Restaurants::where('city_id', $result)->get();
            return($result_set);
        }
        return false;
    }

    public static function getDetailByState($user_config) {
        if (($user_config['state'] != '')) {
            $result = \App\State::where('state', 'LIKE', $user_config['state'] . '%')->pluck('id');
            $result_set = Restaurants::where('state_id', $result)->get();
            return($result_set);
        }
        return false;
    }

    public static function getBannerSearchData($user_config) {
        if (($user_config['name'] != '') && ($user_config['city'] != '') && ($user_config['state'] != '') && ($user_config['zip'] != '')) {
            $result['city'] = \App\City::where('city', 'LIKE', $user_config['city'] . '%')->pluck('id');
            $result['state'] = \App\State::where('state', 'LIKE', $user_config['state'] . '%')->pluck('id');
            $result_set = Restaurants::where('name', 'LIKE', $user_config['name'] . '%')->where('state_id', $result['state'])->where('city_id', $result['city'])->where('zip', $user_config['zip'])->get();
            return($result_set);
        }
        else
        {
            if (($user_config['name'] != '') || ($user_config['city'] != '') || ($user_config['state'] != '') ||($user_config['zip'] != '')) {
                if(($user_config['name'] != '')){
                    $result_set = Restaurants::where('name', 'LIKE', $user_config['name'] . '%')->get();
                    return($result_set);
                }
                else if($user_config['city'] != ''){
                    $result = \App\City::where('city', 'LIKE', $user_config['city'] . '%')->pluck('id');
                    $result_set = Restaurants::where('city_id', $result)->get();
                    return($result_set);
                }
                else if(($user_config['name'] != '') && ($user_config['city'] != '')){
                    $result = \App\City::where('city', 'LIKE', $user_config['city'] . '%')->pluck('id');
                    $result_set = Restaurants::where('city_id', $result)->where('name','LIKE', $user_config['name'] . '%')->get();
                    return($result_set);

                }
                else{
                    return  (false);
                }
            }

        }
    }
}
