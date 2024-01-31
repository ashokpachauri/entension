<?php

namespace App\Filament\Resources\CatagoriesResource\Pages;

use App\Filament\Resources\CatagoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatagories extends EditRecord
{
    protected static string $resource = CatagoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
