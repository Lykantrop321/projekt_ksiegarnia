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
        Schema::create('pracownicy', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('imie'); // Imię pracownika
            $table->string('nazwisko'); // Nazwisko pracownika
            $table->string('login')->unique(); // Login pracownika - musi być unikalny
            $table->string('haslo'); // Hasło pracownika
            $table->timestamps(); // Timestamps dodaje created_at i updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pracownicy');
    }
};
