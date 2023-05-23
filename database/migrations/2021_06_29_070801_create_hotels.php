<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('hotel_id');
            $table->string('hotel_name');
            $table->string('hotel_address');
            $table->string('hotel_phone')->nullable();
            $table->string('hotel_email')->nullable();
            $table->string('hotel_reservation_info_emails')->nullable();
            $table->string('hotel_zone');
            $table->string('hotel_city');
            $table->string('hotel_map')->nullable();
            $table->longText('short_desc')->nullable();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('hotels');
    }
}
