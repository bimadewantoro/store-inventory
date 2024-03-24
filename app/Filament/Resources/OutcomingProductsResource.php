<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutcomingProductsResource\Pages;
use App\Filament\Resources\OutcomingProductsResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductInventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutcomingProductsResource extends Resource
{
    protected static ?string $model = ProductInventory::class;

    protected static ?string $pluralModelLabel = 'Produk Keluar';

    protected static ?string $navigationLabel = 'Produk Keluar';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Cari Produk')
                    ->options(Product::all()->pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('stock')
                    ->label('Jumlah Stok')
                    ->integer()
                    ->required(),
                Forms\Components\Select::make('is_good_condition')
                    ->label('Kondisi Barang')
                    ->options([
                        '1' => 'Baik',
                        '0' => 'Tidak Baik',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->nullable(),
                Forms\Components\Hidden::make('inventory_type')
                    ->default('out'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Jumlah Stok')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan Pada')
                    ->searchable()
                    ->date('d M Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListOutcomingProducts::route('/'),
            'create' => Pages\CreateOutcomingProducts::route('/create'),
            'edit' => Pages\EditOutcomingProducts::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('inventory_type', 'out');
    }
}
