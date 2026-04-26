<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserRegistrationsChart extends ChartWidget
{
    protected ?string $heading = 'User Registrations';
    protected ?string $description = 'New user signups over the last 6 months';
    protected static ?int $sort = 2;
    protected string $color = 'info';
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
            $data[]   = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label'           => 'New Users',
                    'data'            => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.7)',
                    'borderColor'     => 'rgb(59, 130, 246)',
                    'borderWidth'     => 2,
                    'borderRadius'    => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
