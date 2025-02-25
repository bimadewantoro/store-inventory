<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyReportResource\Pages;
use App\Filament\Resources\DailyReportResource\RelationManagers;
use App\Models\ProductInventory;
use Carbon\Carbon;
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

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationLabel = 'Laporan Produk';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->getStateUsing(function($record) {
                        return Carbon::parse($record->created_at)->format('d-m-Y');
                    })
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Jenis')
                    ->getStateUsing(function (ProductInventory $record) {
                        return $record->inventory_type === 'in' ? 'Stok Masuk' : 'Stok Keluar';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Stok Masuk' => 'warning',
                        'Stok Keluar' => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Stok Masuk' => 'heroicon-o-arrow-down-circle',
                        'Stok Keluar' => 'heroicon-o-arrow-up-circle',
                    }),
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
                Tables\Columns\TextColumn::make('notes')
                    ->label('Keterangan')
                    ->searchable(),
            ])
            ->filters([
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
        return parent::getEloquentQuery();
    }

    public static function getPluralModelLabel(): string
    {
        return "Laporan Produk";
    }
}
