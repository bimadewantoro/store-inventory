<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function inventories()
    {
        return $this->hasMany(ProductInventory::class);
    }

    public function getTotalStockAttribute()
    {
        return $this->inventories()->where('inventory_type', 'in')->sum('stock')
            - $this->inventories()->where('inventory_type', 'out')->sum('stock');
    }

    public function getTotalGoodStockAttribute()
    {
        return $this->inventories()->where('is_good_condition', true)->where('inventory_type', 'in')->sum('stock')
            - $this->inventories()->where('is_good_condition', true)->where('inventory_type', 'out')->sum('stock');
    }

    public function getTotalBadStockAttribute()
    {
        return $this->inventories()->where('is_good_condition', false)->where('inventory_type', 'in')->sum('stock')
            - $this->inventories()->where('is_good_condition', false)->where('inventory_type', 'out')->sum('stock');
    }
}
