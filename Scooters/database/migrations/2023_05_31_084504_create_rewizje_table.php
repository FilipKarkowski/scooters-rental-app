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
        Schema::create('rewizje', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Data');
            $table->boolean('Czy_uszkodzona');
            $table->string('Opis');
            $table->decimal('Koszt_uszkodzen');
            $table->unsignedInteger('hulajnoga_id');
            $table->foreign('hulajnoga_id')->references('id')->on('hulajnogi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewizje');
    }
};
