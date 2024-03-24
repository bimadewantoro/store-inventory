<?php

namespace App\Filament\Resources\OutcomingProductsResource\Pages;

use App\Filament\Resources\OutcomingProductsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutcomingProducts extends EditRecord
{
    protected static string $resource = OutcomingProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
