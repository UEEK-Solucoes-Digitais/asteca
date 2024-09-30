<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("properties", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('neighborhood_id');
            $table->unsignedBigInteger('city_id');
            $table->string("title", 100);
            $table->string("url", 100);
            $table->string("image", 100);
            $table->string("image_webp", 100);
            $table->string("address", 150);
            $table->text("description");
            $table->string("area", 20);
            $table->decimal('price', $precision = 10, $scale = 2);
            $table->decimal('condominium_value', $precision = 8, $scale = 2);
            $table->string("whatsapp", 20);
            $table->integer("position");
            $table->tinyInteger("status");
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("properties");
    }
};
