<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProformainvoiceprocess extends Migration
{
    /**
     * Run the migrations.
     *P
     * @return void
     */
    public function up()
    {
        Schema::create('proforma', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('gender');
            $table->string('fullname');
            $table->string('city');
            $table->integer('perNight');
            $table->integer('ReceiptNo');
            $table->integer('surchargepayment');
            $table->string('surchargePaymentUnit');
            $table->integer('surchargepayment2');
            $table->string('surchargePaymentUnit2');
            $table->integer('DHI');
            $table->string('DHIUnit');
            $table->string('services');
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
        Schema::dropIfExists('proforma');
    }
}
