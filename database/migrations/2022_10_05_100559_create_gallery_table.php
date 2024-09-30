<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    /*
	type(1 = imoveis, 2 = lancamentos, 3 = construction, 4 = unidade_disponivel, 5 = page_home, 6 = page_about)
     */
    {
        Schema::create("gallery", function (Blueprint $table) {
            $table->id();
            $table->string("image", 100);
            $table->string("image_webp", 100);
            $table->string("video", 100);
            $table->string("alt_text", 70);
            $table->integer("type");
            $table->integer("item_id");
            $table->integer('position');
            $table->tinyInteger("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("gallery");
    }
};
