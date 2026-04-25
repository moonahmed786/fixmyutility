<?php

namespace App\Filament\Resources\UtilityProviders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UtilityProviderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('country')
                    ->required(),
                Select::make('utility_type')
                    ->options([
            'electricity' => 'Electricity',
            'gas' => 'Gas',
            'water' => 'Water',
            'internet' => 'Internet',
            'other' => 'Other',
        ])
                    ->required(),
                TextInput::make('logo'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
