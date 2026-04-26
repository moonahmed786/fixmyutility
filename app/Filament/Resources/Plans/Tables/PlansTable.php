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
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('price_usd')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price_gbp')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price_cad')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('stripe_price_id_usd')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stripe_price_id_gbp')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stripe_price_id_cad')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('bill_limit')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
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
