<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateWypozyczeniaTable extends Migration
{
    public function up()
    {
        Schema::create('wypozyczenia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klient_id');
            $table->dateTime('data_wypozyczenia');
            $table->dateTime('data_zakonczenia');
            $table->unsignedBigInteger('pracownik_id');
            $table->boolean('odebrane')->default(false);
            $table->timestamps();

            $table->foreign('klient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pracownik_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('wypozyczenia_hulajnogi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wypozyczenie_id');
            $table->unsignedInteger('hulajnoga_id');
            $table->timestamps();

            $table->foreign('wypozyczenie_id')->references('id')->on('wypozyczenia')->onDelete('cascade');
            $table->foreign('hulajnoga_id')->references('id')->on('hulajnogi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wypozyczenia_hulajnogi');
        Schema::dropIfExists('wypozyczenia');
    }
}

