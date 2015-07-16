<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    /*
     * Table name is city
     */
	protected $table = 'city';

    /*
     * One-to Many Relationship
     * A City has many restaurants
     */
    public function restaurants()
    {
        return $this->hasMany('App\Restaurants');
    }

}
