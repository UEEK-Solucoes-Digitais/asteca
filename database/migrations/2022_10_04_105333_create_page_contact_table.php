<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create("page_contact", function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            $table->text("text");
            $table->string("seo_title", 250);
            $table->text("seo_text");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("page_contact");
    }
};
