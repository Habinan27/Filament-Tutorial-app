<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UserPieChartWidget extends ChartWidget
{
    protected ?string $heading = 'User Pie Chart Widget';

    //protected ?string $maxHeight = '400px';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'users created',
                    'data' => [60, 10, 56, 22],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(7, 255, 44)',
                    ],
                ],
            ],
            'labels' => ['Srilanka', 'India', 'USA', 'Canada',],

        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
