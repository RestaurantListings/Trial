<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    /*
     * Table name is county
     */
    protected $table = 'country';

    /*
     * One To Many Relationship
     * A country has many Restaurants
     */
    public function restaurants()
    {
        return $this->hasMany('App\Restaurants');
    }
}
