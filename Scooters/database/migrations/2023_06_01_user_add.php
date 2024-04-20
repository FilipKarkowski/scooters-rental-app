<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            //$table->timestamp('email_verified_at')->default('')->nullable();
            $table->string('password')->default('')->nullable();
            $table->decimal('salary', 10, 2)->nullable(); // Dodaj pole dla pensji
            $table->string('role')->default('client'); // Dodaj pole dla roli, domyślnie 'employee'
            $table->rememberToken();
            $table->timestamps();

            // Dodaj pole id_placowki
            $table->unsignedBigInteger('id_placowki')->nullable();
            $table->foreign('id_placowki')->references('id')->on('placowki')->onDelete('cascade');
            $table->string('opis')->default('')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Usuń pole id_placowki
            $table->dropForeign(['id_placowki']);
            $table->dropColumn('id_placowki');
        });

        Schema::dropIfExists('users');
    }
};
