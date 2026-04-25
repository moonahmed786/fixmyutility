<?php

namespace App\Filament\Resources\Disputes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DisputeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bill_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('bill_analysis_id')
                    ->numeric(),
                Select::make('status')
                    ->options([
            'draft' => 'Draft',
            'sent' => 'Sent',
            'in_review' => 'In review',
            'resolved' => 'Resolved',
            'rejected' => 'Rejected',
        ])
                    ->default('draft')
                    ->required(),
                TextInput::make('letter_pdf_path'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                DateTimePicker::make('sent_at'),
                DateTimePicker::make('resolved_at'),
            ]);
    }
}
