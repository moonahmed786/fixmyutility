<?php

namespace App\Filament\Widgets;

use App\Models\Bill;
use Filament\Widgets\ChartWidget;

class UtilityTypeChart extends ChartWidget
{
    protected ?string $heading = 'Bills by Utility Type';
    protected ?string $description = 'Distribution of submitted bills by utility category';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $types = ['electricity', 'gas', 'water', 'internet', 'other'];
        $data  = [];

        foreach ($types as $type) {
            $data[] = Bill::where('utility_type', $type)->count();
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Bills',
                    'data'            => $data,
                    'backgroundColor' => [
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(156, 163, 175, 0.8)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Electricity', 'Gas', 'Water', 'Internet', 'Other'],
        ];
    }
}
