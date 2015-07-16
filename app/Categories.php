<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    /*
     * Table name is categories
     */
    protected $table = 'categories';

    /*
     * One-to Many Relationship
     * A Categories has many restaurants
     */
    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurants');
    }


}
