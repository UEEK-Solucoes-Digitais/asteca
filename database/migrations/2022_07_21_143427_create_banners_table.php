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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            $table->text("text");
            $table->string("btn_text", 40);
            $table->string("btn_link", 200);
            $table->string("image", 100);
            $table->string("image_webp", 100);
            $table->string("second_title", 100);
            $table->string("logo", 100);
            $table->string("logo_webp", 100);
            $table->integer('position');
            $table->timestamps();
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
