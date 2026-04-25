<?php

namespace App\Filament\Resources\Bills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('utility_provider_id')
                    ->numeric(),
                Select::make('utility_type')
                    ->options([
            'electricity' => 'Electricity',
            'gas' => 'Gas',
            'water' => 'Water',
            'internet' => 'Internet',
            'other' => 'Other',
        ])
                    ->required(),
                TextInput::make('currency')
                    ->required()
                    ->default('USD'),
                TextInput::make('amount')
                    ->numeric(),
                DatePicker::make('billing_period_start'),
                DatePicker::make('billing_period_end'),
                TextInput::make('file_path'),
                Textarea::make('extracted_text')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
            'uploaded' => 'Uploaded',
            'processing' => 'Processing',
            'analyzed' => 'Analyzed',
            'disputed' => 'Disputed',
            'resolved' => 'Resolved',
            'failed' => 'Failed',
        ])
                    ->default('uploaded')
                    ->required(),
            ]);
    }
}
