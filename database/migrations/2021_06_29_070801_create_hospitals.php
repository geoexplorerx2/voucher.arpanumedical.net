<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('hospital_id');
            $table->string('hospital_name');
            $table->string('hospital_address');
            $table->string('hospital_phone')->nullable();
            $table->string('hospital_email')->nullable();
            $table->string('hospital_zone');
            $table->string('hospital_city');
            $table->string('hospital_map')->nullable();
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
        Schema::dropIfExists('hospitals');
    }
}
