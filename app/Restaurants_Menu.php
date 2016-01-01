<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurants_Menu extends Model {

	protected $table = 'restaurants_menu';

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants');
    }
}
