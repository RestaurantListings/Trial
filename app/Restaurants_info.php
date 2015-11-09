<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurants_info extends Model {

    /*
     * Table name is restaurants_info
     */
	protected $table = 'restaurants_info';

    /*
     * One-to One Relationship
     * A Restaurants_info belongs to a restaurants
     */
    public function restaurants()
    {
        return $this->belongTo('App\Restaurants');
    }


}
