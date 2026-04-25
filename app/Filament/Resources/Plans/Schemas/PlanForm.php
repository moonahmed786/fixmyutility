<?php

namespace App\Filament\Resources\Plans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('price_usd')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('price_gbp')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('price_cad')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('stripe_price_id_usd'),
                TextInput::make('stripe_price_id_gbp'),
                TextInput::make('stripe_price_id_cad'),
                \Filament\Forms\Components\TagsInput::make('features')
                    ->placeholder('Add a feature and press Enter')
                    ->required(),
                TextInput::make('bill_limit')
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
