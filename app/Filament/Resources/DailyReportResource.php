<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyReportResource\Pages;
use App\Filament\Resources\DailyReportResource\RelationManagers;
use App\Models\ProductInventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyReportResource extends Resource
{
    protected static ?string $model = ProductInventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralModelLabel = 'Laporan Harian';

    protected static ?string $navigationLabel = 'Laporan Harian';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_good_condition')
                    ->label('Kondisi Barang')
                    ->getStateUsing(function ($record) {
                        return $record->is_good_condition ? 'BAIK' : 'TIDAK BAIK';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'BAIK' => 'success',
                        'TIDAK BAIK' => 'danger',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->getStateUsing(function (ProductInventory $record) {
                        return $record->inventory_type === 'in' ? 'Stok Masuk' : 'Stok Keluar';
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan Pada')
                    ->searchable()
                    ->date('d M Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyReports::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereDate('created_at', now()->format('Y-m-d'));
    }

    public function getHeading(): string
    {
        return __('Custom Page Heading');
    }
}
