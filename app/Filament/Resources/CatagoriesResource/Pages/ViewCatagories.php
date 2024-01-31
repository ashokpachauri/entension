<?php

namespace App\Filament\Resources\CatagoriesResource\Pages;

use App\Filament\Resources\CatagoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCatagories extends ViewRecord
{
    protected static string $resource = CatagoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
