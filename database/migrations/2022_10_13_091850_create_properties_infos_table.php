<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("properties_infos", function (Blueprint $table) {
            $table->id();
            $table->string("property_id");
            $table->string("info_title", 100);
            $table->decimal('info_value', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("properties_infos");
    }
};
