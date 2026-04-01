<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalePhone extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'purchase_price',
        'repair_cost',
        'repair_description',
        'sale_price',
        'status',
        'images',
        'sold_at',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'repair_cost' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'images' => 'array',
        'sold_at' => 'datetime',
    ];
}
