<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("constructions", function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            $table->text("text");
            $table->string("image", 100);
            $table->string("image_webp", 100);
            $table->integer("position");
            $table->tinyInteger("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("constructions");
    }
};
