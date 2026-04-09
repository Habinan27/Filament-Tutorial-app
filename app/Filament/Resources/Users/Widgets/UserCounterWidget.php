<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCounterWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users',User::count())
                ->description('Total number of users of this year')
                ->color('success'),
            Stat::make('Total User from India',User::whereHas('country',fn($q) => $q->where('name' , 'India'))->count()),
            Stat::make('Total User from Srilanka',User::whereHas('country',fn($q) => $q->where('name' , 'Srilanka'))->count())
        ];
    }
}
