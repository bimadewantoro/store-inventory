<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $pluralModelLabel = 'Produk';

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Barang')
                    ->required(),
                Forms\Components\TextInput::make('product_code')
                    ->label('Kode Barang')
                    ->helperText('Pastikan kode barang belum pernah digunakan sebelumnya.')
                    ->unique()
                    ->validationMessages([
                        'unique' => 'Kode barang sudah pernah digunakan sebelumnya.',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi Barang')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_code')
                    ->label('Kode Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_stock')
                    ->label('Total Stok'),
                Tables\Columns\TextColumn::make('total_good_stock')
                    ->label('Kondisi Baik'),
                Tables\Columns\TextColumn::make('total_bad_stock')
                    ->label('Kondisi Tidak Baik'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
