<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->foreign('hospital_id')->references('hospital_id')
                ->on('hospitals')
                ->onDelete('cascade');
            $table->date('foreseen_date')->nullable();
            $table->string('medical_type')->nullable();
            $table->longText('desc')->nullable();
            $table->string('patient_name')->nullable();
            $table->integer('hotel_id')->unsigned()->nullable();
            $table->foreign('hotel_id')->references('hotel_id')
                ->on('hotels')
                ->onDelete('cascade');
            $table->string('room_type')->nullable();
            $table->string('category')->nullable();
            $table->date('hotel_checkin')->nullable();
            $table->date('hotel_checkout')->nullable();
            $table->string('confirmatiom_num')->nullable();
            $table->string('nights')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('flight_number')->nullable();
            $table->string('arrival_airport')->nullable();
            $table->string('departure_airport')->nullable();
            $table->string('airport_code')->nullable();
            $table->string('contact_person')->nullable();
            $table->longText('payment_detail')->nullable();
            $table->longText('important_note')->nullable();
            $table->string('clinic_balance')->nullable();
            $table->string('prepayment_received')->nullable();
            $table->string('currency')->nullable();
            $table->string('total_package')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}
