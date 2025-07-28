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
        Schema::create('host_fully_property_photos', function (Blueprint $table) {
            $table->id();
             $table->string("property_uid",100);
            $table->string("uid");
            $table->longText("description")->nullable();
            $table->text("url")->nullable();
            $table->string("displayOrder")->nullable();
            $table->string("airbnbRoomId")->nullable();
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
        Schema::dropIfExists('host_fully_property_photos');
    }
};
