<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('podsumowania', function (Blueprint $table) {
            $table->id();
            $table->integer('ilosc_wypozyczen')->nullable();
            $table->integer('ilosc_odbiorow')->nullable();
            $table->decimal('koszt')->nullable();
            $table->integer('liczba_uszkodzonych')->nullable();
            $table->integer('koszt_uszkodzen')->nullable();

            $table->unsignedBigInteger('odbior_id')->nullable();
            $table->unsignedBigInteger('wypozyczenie_id')->nullable();
            $table->unsignedInteger('rewizja_id')->nullable();

            $table->foreign('wypozyczenie_id')->references('id')->on('wypozyczenia')->onDelete('cascade');
            $table->foreign('odbior_id')->references('id')->on('odbiory')->onDelete('cascade');
            $table->foreign('rewizja_id')->references('id')->on('rewizje')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podsumowania');
    }
};
