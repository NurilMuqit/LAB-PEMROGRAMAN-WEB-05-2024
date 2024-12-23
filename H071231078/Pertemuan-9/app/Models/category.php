<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relasi ke Product (One to Many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
