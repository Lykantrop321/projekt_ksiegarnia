<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePracownikRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'imie' => 'required|max:255',
            'nazwisko' => 'required|max:255',
            'login' => 'required|unique:pracownicy,login,' . $this->pracownik,
            'haslo' => 'sometimes|min:6',
        ];
    }
}
php artisan db:seed



