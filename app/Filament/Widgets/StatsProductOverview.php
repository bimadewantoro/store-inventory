<?php

namespace App\Filament\Widgets;

use App\Models\ProductInventory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;

class StatsProductOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Total jenis produk yang tersedia')
                ->icon('heroicon-o-archive-box'),
            Stat::make('Total Stok Produk', ProductInventory::where('inventory_type', 'in')->sum('stock') - ProductInventory::where('inventory_type', 'out')->sum('stock'))
                ->description('Total stok produk yang tersedia')
                ->icon('heroicon-o-chart-bar-square'),
            Stat::make('Total Stok Produk Masuk', ProductInventory::where('inventory_type', 'in')->sum('stock'))
                ->description('Total stok produk yang masuk')
                ->icon('heroicon-o-arrow-uturn-down')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-down'),
            Stat::make('Total Stok Produk Keluar', ProductInventory::where('inventory_type', 'out')->sum('stock'))
                ->description('Total stok produk yang keluar')
                ->icon('heroicon-o-arrow-uturn-up')
                ->color('danger')
                ->descriptionIcon('heroicon-m-arrow-up'),
        ];
    }
}
