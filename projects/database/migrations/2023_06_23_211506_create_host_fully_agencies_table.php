<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('host_fully_agencies', function (Blueprint $table) {
            $table->id();


            $table->string("uid")->nullable();
            $table->string("name")->nullable();
            $table->string("agencyEmailAddress")->nullable();
            $table->string("phoneNumber")->nullable();
            $table->string("website")->nullable();
            $table->string("address1")->nullable();
            $table->string("city")->nullable();
            $table->string("zipCode")->nullable();
            $table->string("state")->nullable();
            $table->string("currency")->nullable();
            $table->string("currencyCode")->nullable();
            $table->string("countryCode")->nullable();
            $table->string("defaultCheckInTime")->nullable();
            $table->string("defaultCheckOutTime")->nullable();
            $table->longText("rentalCondition")->nullable();
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
        Schema::dropIfExists('host_fully_agencies');
    }
};
