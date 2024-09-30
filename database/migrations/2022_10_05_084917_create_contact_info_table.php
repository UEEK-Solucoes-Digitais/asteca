<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("contact_info", function (Blueprint $table) {
            $table->id();
            $table->string("phone", 20);
            $table->string("facebook", 200);
            $table->string("instagram", 200);
            $table->string("whatsapp", 20);
            $table->string("email", 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("contact_info");
    }
};
