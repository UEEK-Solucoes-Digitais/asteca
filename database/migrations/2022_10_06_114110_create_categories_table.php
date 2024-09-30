<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("categories", function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->integer('position');

            $table->tinyInteger("status");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("categories");
    }
};