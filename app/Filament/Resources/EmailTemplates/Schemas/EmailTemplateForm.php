<?php

namespace App\Filament\Resources\EmailTemplates\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmailTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                \Filament\Forms\Components\RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                \Filament\Forms\Components\TagsInput::make('variables')
                    ->placeholder('Add a variable (e.g. {{name}}) and press Enter'),
            ]);
    }
}
