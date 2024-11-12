<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory_logs extends Model
{
    //
    protected $table='inventory_logs';
    protected $fillable = [
        'product_id',
        'quantity',
        'type',
        'price'
    ];
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
