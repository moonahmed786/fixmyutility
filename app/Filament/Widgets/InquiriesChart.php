<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use Filament\Widgets\ChartWidget;

class InquiriesChart extends ChartWidget
{
    protected ?string $heading = 'Inquiries / Leads';
    protected ?string $description = 'New leads received over the last 6 months';
    protected static ?int $sort = 6;
    protected string $color = 'danger';
    protected int | string | array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $labels = [];
        $data   = [];

        for ($i = 5; $i >= 0; $i--) {
            $date     = now()->subMonths($i);
            $labels[] = $date->format('M Y');
            $data[]   = Inquiry::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label'           => 'New Leads',
                    'data'            => $data,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.7)',
                    'borderColor'     => 'rgb(239, 68, 68)',
                    'borderWidth'     => 2,
                    'borderRadius'    => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
