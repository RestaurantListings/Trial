<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('restaurants_reviews', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('restaurant_id');
            $table->integer('user_id');
            $table->text('text');
            $table->text('source');
            $table->text('source_link');
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
		Schema::drop('restaurants_reviews');
	}

}
