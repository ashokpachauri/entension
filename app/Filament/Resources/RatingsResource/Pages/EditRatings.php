<?php

namespace App\Filament\Resources\RatingsResource\Pages;

use App\Filament\Resources\RatingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRatings extends EditRecord
{
    protected static string $resource = RatingsResource::class;

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
