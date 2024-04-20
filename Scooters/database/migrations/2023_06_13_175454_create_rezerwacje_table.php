<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rezerwacje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('klient_id');
            $table->dateTime('data_wypozyczenia');
            $table->dateTime('data_zakonczenia');
            $table->unsignedBigInteger('placowka_id');
            $table->timestamps();

            $table->foreign('klient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('placowka_id')->references('id')->on('placowki')->onDelete('cascade');
        });

        Schema::create('rezerwacje_hulajnogi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rezerwacja_id');
            $table->unsignedInteger('hulajnoga_id');
            $table->timestamps();

            $table->foreign('rezerwacja_id')->references('id')->on('rezerwacje')->onDelete('cascade');
            $table->foreign('hulajnoga_id')->references('id')->on('hulajnogi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rezerwacje');
        Schema::dropIfExists('rezerwacje_hulajnogi');
    }
};
