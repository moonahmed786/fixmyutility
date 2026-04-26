<?php

namespace App\Filament\Resources\Bills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('utility_provider_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('utility_type')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('currency')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('billing_period_start')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('billing_period_end')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('file_path')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
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
