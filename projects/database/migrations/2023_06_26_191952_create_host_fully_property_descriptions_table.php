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
        Schema::create('host_fully_property_descriptions', function (Blueprint $table) {
            $table->id();
             $table->string("property_uid",100);

              $table->string("name",1025)->nullable();
              $table->longText("shortSummary")->nullable();
              $table->longText("summary")->nullable();
              $table->longText("notes")->nullable();
              $table->longText("access")->nullable();
              $table->longText("interaction")->nullable();
              $table->longText("neighbourhood")->nullable();
              $table->longText("space")->nullable();
              $table->longText("houseManual")->nullable();
              $table->longText("locale")->nullable();
              $table->longText("transit")->nullable();
   

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
        Schema::dropIfExists('host_fully_property_descriptions');
    }
};
