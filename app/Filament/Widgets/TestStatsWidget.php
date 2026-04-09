<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;    

    protected function getStats(): array
    {
        return [
            Stat::make('Total users', User::count())
                ->description('Total number of users in this year')
                ->descriptionIcon(Heroicon::ArrowUpLeft , IconPosition::Before)
                ->chart(    
                    User::selectRaw('Month(created_at) as month, count(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('success')
                ->descriptionColor('success'),

            Stat::make('Total Posts', Post::count())
                ->description('Total number of posts in this year')
                ->descriptionIcon(Heroicon::ArrowUpLeft , IconPosition::Before)
                ->chart(    
                    Post::selectRaw('Month(created_at) as month, count(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('info')
                ->descriptionColor('info'),

            Stat::make('Total Products', Product::count())
                ->description('Total number of products in this year')
                ->descriptionIcon(Heroicon::ArrowUpLeft , IconPosition::Before)
                ->chart(    
                    Product::selectRaw('Month(created_at) as month, count(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('primary')
                ->descriptionColor('primary'),
        ];
    }
}
