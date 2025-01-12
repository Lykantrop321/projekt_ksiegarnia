<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pracownik extends Model
{
    use HasFactory;

    protected $table = 'pracownicy'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'imie',
        'nazwisko',
        'login',
        'haslo',
    ];

    // Jeżeli masz relacje do innych modeli, tutaj można je zdefiniować
}
