<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("release_units", function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            $table->unsignedBigInteger('release_id');
            $table->string("image", 100);
            $table->string("image_webp", 100);
            $table->tinyInteger("status");
            $table->foreign('release_id')->references('id')->on('our_releases');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("release_units");
    }
};
