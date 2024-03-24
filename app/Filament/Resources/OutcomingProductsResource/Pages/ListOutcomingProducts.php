<?php

namespace App\Filament\Resources\OutcomingProductsResource\Pages;

use App\Filament\Resources\OutcomingProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOutcomingProducts extends ListRecords
{
    protected static string $resource = OutcomingProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
