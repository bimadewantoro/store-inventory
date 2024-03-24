<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_code',
        'description',
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
        $goodConditionQuery = $this->inventories()->where('is_good_condition', true);

        return $goodConditionQuery->where('inventory_type', 'in')->sum('stock')
            - $goodConditionQuery->where('inventory_type', 'out')->sum('stock');
    }

    public function getTotalBadStockAttribute()
    {
        $badConditionQuery = $this->inventories()->where('is_good_condition', false);

        return $badConditionQuery->where('inventory_type', 'in')->sum('stock')
            - $badConditionQuery->where('inventory_type', 'out')->sum('stock');
    }
}
