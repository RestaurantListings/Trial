<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration {


    protected $table = 'restaurants';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('address_1');
            $table->string('address_2');
            $table->integer('city_id');
            $table->integer('state_id');
            $table->integer('country_id');
            $table->integer('zip');
            $table->string('phone')->nullable;
            $table->string('website')->nullable;
            $table->string('email')->nullable;
            $table->integer('rank');
            $table->float('latitude', 10, 6)->nullable;
            $table->float('longitude', 10, 6)->nullable;
            $table->string('img_one')->nullable;
            $table->string('img_two')->nullable;
            $table->string('img_three')->nullable;
            $table->string('categories');
            $table->string('yelp_link')->nullable;
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('restaurants');
	}

}
