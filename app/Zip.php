<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Zip extends Model {

    /*
     * Table name is categories
     */
    protected $table = 'zip';

    /*
     * One-to Many Relationship
     * A Categories has many restaurants
     */
    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurants');
    }


}
