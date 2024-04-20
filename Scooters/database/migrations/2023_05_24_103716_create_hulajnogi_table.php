<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Class CreateHulajnogiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hulajnogi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nazwa', 255);
            $table->string('Model', 255);
            $table->unsignedBigInteger('placowka_id')->nullable();
            $table->foreign('placowka_id')->references('id')->on('placowki')->onDelete('set null');
            $table->boolean('zajeta')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hulajnogi');
    }
};
