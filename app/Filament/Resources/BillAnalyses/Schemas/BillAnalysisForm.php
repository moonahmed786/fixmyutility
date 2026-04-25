<?php

namespace App\Filament\Resources\BillAnalyses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BillAnalysisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bill_id')
                    ->required()
                    ->numeric(),
                TextInput::make('errors'),
                TextInput::make('overcharge_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('currency')
                    ->required()
                    ->default('USD'),
                Textarea::make('dispute_letter')
                    ->columnSpanFull(),
                TextInput::make('ai_response'),
                TextInput::make('report_pdf_path'),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'completed' => 'Completed', 'failed' => 'Failed'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
