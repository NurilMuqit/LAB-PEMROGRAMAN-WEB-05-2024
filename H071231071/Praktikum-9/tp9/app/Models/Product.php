<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan inventory_logs (one-to-many)
    public function inventoryLogs()
    {
        return $this->hasMany(inventory_logs::class);
    }
}

