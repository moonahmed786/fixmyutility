<?php

namespace App\Filament\Resources\BillAnalyses\Pages;

use App\Filament\Resources\BillAnalyses\BillAnalysisResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBillAnalysis extends EditRecord
{
    protected static string $resource = BillAnalysisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
