<?php

namespace App\Filament\Resources\UtilityProviders\Pages;

use App\Filament\Resources\UtilityProviders\UtilityProviderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUtilityProvider extends EditRecord
{
    protected static string $resource = UtilityProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
