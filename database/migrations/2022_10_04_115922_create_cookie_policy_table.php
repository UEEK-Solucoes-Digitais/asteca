<?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;
        
        return new class extends Migration
        {
            public function up()
            {
                Schema::create("cookie_policy", function (Blueprint $table) {
                    $table->id();
                    $table->text("text");
                    $table->timestamps();
                });
            }
        
            public function down()
            {
                Schema::dropIfExists("cookie_policy");
            }
        };
        