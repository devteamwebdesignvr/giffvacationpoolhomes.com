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
        Schema::create('host_fully_property_price_periods', function (Blueprint $table) {
            $table->id();


$table->string("propertyUid" )->nullable();
$table->date("from" )->nullable();
$table->date("to" )->nullable();
$table->integer("amount" )->nullable();
$table->integer("minimumStay" )->nullable();
$table->string("isCheckinAllowed" ,50)->nullable();
$table->string("isCheckoutAllowed",50 )->nullable();
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
        Schema::dropIfExists('host_fully_property_price_periods');
    }
};
