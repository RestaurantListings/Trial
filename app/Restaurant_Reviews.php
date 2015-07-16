<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant_Reviews extends Model {

	protected $table = 'restaurants_reviews';

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants');
    }
}
