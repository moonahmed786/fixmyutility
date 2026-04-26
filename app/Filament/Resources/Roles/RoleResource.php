<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Access Control';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Roles';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Role Details')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(125)
                        ->columnSpanFull(),
                ]),

            Section::make('Permissions')
                ->description('Select the permissions this role has access to.')
                ->schema([
                    CheckboxList::make('permissions')
                        ->relationship('permissions', 'name')
                        ->columns(3)
                        ->searchable()
                        ->bulkToggleable()
                        ->columnSpanFull()
                        ->gridDirection('row'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin'    => 'danger',
                        'editor'   => 'warning',
                        'customer' => 'success',
                        default    => 'primary',
                    }),
                TextColumn::make('permissions_count')
                    ->label('Permissions')
                    ->counts('permissions')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->color('gray'),
                TextColumn::make('users_count')
                    ->label('Users')
                    ->counts('users')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('guard_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit'   => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }
}
