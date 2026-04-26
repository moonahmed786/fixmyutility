<?php

namespace App\Filament\Resources\Permissions;

use App\Filament\Resources\Permissions\Pages;
use BackedEnum;
use UnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    protected static string|UnitEnum|null $navigationGroup = 'Access Control';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Permissions';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(125)
                    ->helperText('Use dot-notation groups, e.g. users.view, users.create, users.edit, users.delete'),

                Select::make('group')
                    ->options(fn () => Permission::query()
                        ->selectRaw('SUBSTRING_INDEX(name, ".", 1) as grp')
                        ->distinct()
                        ->pluck('grp', 'grp')
                        ->prepend('(new group)', '')
                        ->toArray()
                    )
                    ->searchable()
                    ->dehydrated(false)
                    ->helperText('Informational only — the group is the prefix before the first dot in the name.'),
            ])->columns(2),
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
                    ->toggleable(),
                TextColumn::make('roles_count')
                    ->label('Roles')
                    ->counts('roles')
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->color('primary'),
                TextColumn::make('guard_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('guard_name')
                    ->options(['web' => 'web', 'api' => 'api']),
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
            'index'  => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit'   => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }
}
