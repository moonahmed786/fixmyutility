<?php

namespace App\Filament\Resources\UtilityProviders\Pages;

use App\Filament\Resources\UtilityProviders\UtilityProviderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUtilityProviders extends ListRecords
{
    protected static string $resource = UtilityProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
