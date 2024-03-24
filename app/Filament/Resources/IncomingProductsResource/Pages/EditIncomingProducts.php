<?php

namespace App\Filament\Resources\IncomingProductsResource\Pages;

use App\Filament\Resources\IncomingProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncomingProducts extends EditRecord
{
    protected static string $resource = IncomingProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
