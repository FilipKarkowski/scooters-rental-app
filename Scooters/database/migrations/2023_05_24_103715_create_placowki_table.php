<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacowkiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('placowki', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->string('adres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('placowki');
    }
};
