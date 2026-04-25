<?php

namespace App\Filament\Resources\BillAnalyses;

use App\Filament\Resources\BillAnalyses\Pages\CreateBillAnalysis;
use App\Filament\Resources\BillAnalyses\Pages\EditBillAnalysis;
use App\Filament\Resources\BillAnalyses\Pages\ListBillAnalyses;
use App\Filament\Resources\BillAnalyses\Schemas\BillAnalysisForm;
use App\Filament\Resources\BillAnalyses\Tables\BillAnalysesTable;
use App\Models\BillAnalysis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BillAnalysisResource extends Resource
{
    protected static ?string $model = BillAnalysis::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return BillAnalysisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BillAnalysesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBillAnalyses::route('/'),
            'create' => CreateBillAnalysis::route('/create'),
            'edit' => EditBillAnalysis::route('/{record}/edit'),
        ];
    }
}
