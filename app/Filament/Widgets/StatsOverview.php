<?php

namespace App\Filament\Widgets;

use App\Models\Customers;
use App\Models\Tasks;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{


    protected function getStats(): array
    {
        return [
            Stat::make('Користувачів', User::query()->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Клієнтів', Customers::query()->count())
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Замовлення у роботі', Tasks::where('status', 'В роботі')->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Готові замовлення', Tasks::where('status', 'Завершено')->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
