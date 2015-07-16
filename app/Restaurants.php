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
        return $this->hasMany('App\Restaurant_Reviews');
    }
}
