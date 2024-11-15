<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    // Relasi ke Category (Many to One)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke InventoryLog (One to Many)
    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class);
    }
}
