<?php

namespace App\Filament\Resources\BillAnalyses\Pages;

use App\Filament\Resources\BillAnalyses\BillAnalysisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBillAnalyses extends ListRecords
{
    protected static string $resource = BillAnalysisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
