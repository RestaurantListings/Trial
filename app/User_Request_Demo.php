<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Request_Demo extends Model {

	protected $table = 'user_request_demo';

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurants');
    }
}
