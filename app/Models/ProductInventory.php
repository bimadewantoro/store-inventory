<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'stock',
        'is_good_condition',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
