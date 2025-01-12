<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klient extends Model
{
    use HasFactory;

    protected $table = 'klienci'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'imie',
        'nazwisko',
        'dzien_tygodnia',
        'pracownik_id', // Upewnij się, że istnieje klucz obcy w migracji
    ];

    // Jeżeli istnieje relacja do modelu Pracownik
    public function pracownik()
    {
        return $this->belongsTo(Pracownik::class);
    }
}
