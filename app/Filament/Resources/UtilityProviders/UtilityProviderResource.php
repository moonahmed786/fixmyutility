<?php

namespace App\Filament\Resources\UtilityProviders;

use App\Filament\Resources\UtilityProviders\Pages\CreateUtilityProvider;
use App\Filament\Resources\UtilityProviders\Pages\EditUtilityProvider;
use App\Filament\Resources\UtilityProviders\Pages\ListUtilityProviders;
use App\Filament\Resources\UtilityProviders\Schemas\UtilityProviderForm;
use App\Filament\Resources\UtilityProviders\Tables\UtilityProvidersTable;
use App\Models\UtilityProvider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UtilityProviderResource extends Resource
{
    protected static ?string $model = UtilityProvider::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return UtilityProviderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UtilityProvidersTable::configure($table);
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
            'index' => ListUtilityProviders::route('/'),
            'create' => CreateUtilityProvider::route('/create'),
            'edit' => EditUtilityProvider::route('/{record}/edit'),
        ];
    }
}
