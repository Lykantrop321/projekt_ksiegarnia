<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePracownikRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Można ustawić logikę autoryzacji
    }

    public function rules()
    {
        return [
            'imie' => 'required|max:255',
            'nazwisko' => 'required|max:255',
            'login' => 'required|unique:pracownicy,login',
            'haslo' => 'required|min:6',
        ];
    }
}

