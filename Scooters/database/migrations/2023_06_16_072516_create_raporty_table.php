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
        Schema::create('raporty', function (Blueprint $table) {
            $table->id();
            $table->integer('liczba_wypozyczen');
            $table->integer('liczba_odbiorow');
            $table->integer('liczba_uszkodzonych');
            $table->decimal('zysk');
            $table->unsignedBigInteger('placowka_id')->nullable();
            $table->unsignedBigInteger('odbiory_id')->nullable();
            $table->unsignedInteger('rewizje_id')->nullable();
            $table->unsignedBigInteger('wypozyczenia_id')->nullable();

            $table->foreign('placowka_id')->references('id')->on('placowki')->onDelete('cascade');
            $table->foreign('odbiory_id')->references('id')->on('odbiory')->onDelete('cascade');
            $table->foreign('rewizje_id')->references('id')->on('rewizje')->onDelete('cascade');
            $table->foreign('wypozyczenia_id')->references('id')->on('wypozyczenia')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raporty');
    }
};
