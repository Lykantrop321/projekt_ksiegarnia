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
        Schema::create('klienci', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('imie'); // Imię klienta
            $table->string('nazwisko'); // Nazwisko klienta
            $table->string('dzien_tygodnia'); // Dzień tygodnia, w którym klient uczestniczy
            $table->foreignId('pracownik_id')->constrained('pracownicy')->onDelete('cascade'); // Klucz obcy powiązany z pracownikami
            $table->timestamps(); // Timestamps dodaje created_at i updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klienci');
    }
};
