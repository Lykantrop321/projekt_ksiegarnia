<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'price', 'quantity']; // Dodanie 'quantity' do listy atrybutów, które można masowo przypisywać

    /**
     * Get the reviews for the book.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class); // Zakładając, że istnieje model Review
    }
}
