<?php

namespace App\Filament\Widgets;

use App\Models\Dispute;
use Filament\Widgets\ChartWidget;

class DisputeStatusChart extends ChartWidget
{
    protected ?string $heading = 'Disputes by Status';
    protected ?string $description = 'Current breakdown of all disputes';
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 1;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $statuses = ['draft', 'sent', 'in_review', 'resolved', 'rejected'];
        $data     = [];

        foreach ($statuses as $status) {
            $data[] = Dispute::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Disputes',
                    'data'            => $data,
                    'backgroundColor' => [
                        'rgba(156, 163, 175, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Draft', 'Sent', 'In Review', 'Resolved', 'Rejected'],
        ];
    }
}
