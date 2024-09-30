<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("page_about", function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            $table->text("text");
            $table->string("image");
            $table->string("image_webp");
            $table->string("msv_title", 100);
            $table->text("mission_text");
            $table->text("vision_text");
            $table->text("values_text");
            $table->string("history_title", 100);
            $table->text("history_text");
            $table->string("seo_title", 250);
            $table->text("seo_text");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("page_about");
    }
};
