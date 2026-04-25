<?php

namespace App\Filament\Resources\Plans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('price_usd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_gbp')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_cad')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stripe_price_id_usd')
                    ->searchable(),
                TextColumn::make('stripe_price_id_gbp')
                    ->searchable(),
                TextColumn::make('stripe_price_id_cad')
                    ->searchable(),
                TextColumn::make('bill_limit')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
