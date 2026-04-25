<?php

namespace App\Filament\Resources\Inquiries;

use App\Filament\Resources\Inquiries\Pages;
use App\Models\Inquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Leads / Inquiries';

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?string $pluralLabel = 'Inquiries';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subject')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->options([
                                'new'         => 'New',
                                'in_progress' => 'In Progress',
                                'responded'   => 'Responded',
                                'closed'      => 'Closed',
                            ])
                            ->required()
                            ->default('new'),
                        Forms\Components\TextInput::make('service_slug')
                            ->label('Source Service')
                            ->disabled()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'         => 'danger',
                        'in_progress' => 'warning',
                        'responded'   => 'primary',
                        'closed'      => 'success',
                        default       => 'gray',
                    }),
                Tables\Columns\TextColumn::make('service_slug')
                    ->label('Source Service')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new'         => 'New',
                        'in_progress' => 'In Progress',
                        'responded'   => 'Responded',
                        'closed'      => 'Closed',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInquiries::route('/'),
        ];
    }
}
