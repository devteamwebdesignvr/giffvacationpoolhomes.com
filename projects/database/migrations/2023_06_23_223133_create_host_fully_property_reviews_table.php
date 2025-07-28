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
        Schema::create('host_fully_property_reviews', function (Blueprint $table) {
            $table->id();
            $table->string("property_uid",100);

              $table->string("uid")->nullable();
            $table->string("author")->nullable();
            $table->text("title")->nullable();
            $table->longText("content")->nullable();
            $table->string("rating")->nullable();
            $table->string("date")->nullable();
            $table->string("propertyUid")->nullable();
            $table->string("leadUid")->nullable();
            $table->string("source")->nullable();
            $table->longText("privateFeedback")->nullable();
            $table->longText("reviewResponse")->nullable();
            $table->text("ratingCategories")->nullable();
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
        Schema::dropIfExists('host_fully_property_reviews');
    }
};
