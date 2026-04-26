<?php

namespace App\Filament\Widgets;

use App\Models\Bill;
use Filament\Widgets\ChartWidget;

class BillsSubmittedChart extends ChartWidget
{
    protected ?string $heading = 'Bills Submitted';
    protected ?string $description = 'Bills uploaded over the last 6 months';
    protected static ?int $sort = 3;
    protected string $color = 'primary';
    protected int | string | array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $labels = [];
        $data   = [];

        for ($i = 5; $i >= 0; $i--) {
            $date     = now()->subMonths($i);
            $labels[] = $date->format('M Y');
            $data[]   = Bill::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label'           => 'Bills Submitted',
                    'data'            => $data,
                    'borderColor'     => 'rgb(124, 92, 62)',
                    'backgroundColor' => 'rgba(124, 92, 62, 0.1)',
                    'borderWidth'     => 2,
                    'fill'            => true,
                    'tension'         => 0.4,
                    'pointRadius'     => 5,
                    'pointHoverRadius'=> 7,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
