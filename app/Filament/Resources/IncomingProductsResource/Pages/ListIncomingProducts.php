<?php

namespace App\Filament\Resources\IncomingProductsResource\Pages;

use App\Filament\Resources\IncomingProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomingProducts extends ListRecords
{
    protected static string $resource = IncomingProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
