<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    /*
     * Table name is state
     */
    protected $table = 'state';

    /*
     * One to Many Relationship
     * A State has many restaurants
     */
    public function restaurants()
    {
        return $this->hasMany('App\Restaurants');
    }


}
