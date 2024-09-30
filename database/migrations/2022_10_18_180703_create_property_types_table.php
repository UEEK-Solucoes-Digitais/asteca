<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("property_types", function (Blueprint $table) {
            $table->id();
            $table->string("name", 120);
            $table->integer("position");
            $table->timestamps();
            $table->tinyInteger("status");
        });
    }

    public function down()
    {
        Schema::dropIfExists("property_types");
    }
};
