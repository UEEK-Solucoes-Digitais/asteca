<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("our_releases", function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            $table->string("subtitle", 150);
            $table->text("description");
            $table->date("initial_date");
            $table->string("percentage_done", 3);
            $table->date("final_date");
            $table->decimal("latitude", $precision = 8, $scale = 2);
            $table->decimal("longitude", $precision = 9, $scale = 2);
            $table->tinyInteger("status");
            $table->integer("position");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("our_releases");
    }
};
