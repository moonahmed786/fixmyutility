<?php

namespace App\Filament\Resources\Disputes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DisputesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bill_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('bill_analysis_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('letter_pdf_path')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('resolved_at')
                    ->dateTime()
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
