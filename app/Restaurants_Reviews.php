<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurants_Reviews extends Model {

	protected $table = 'restaurants_reviews';

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants');
    }
}
