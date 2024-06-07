<?php

namespace App\Filament\Widgets;

use App\Models\Tasks;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EarnChat extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        // Get all tasks
        $tasks = Tasks::all();

        // Group tasks by company and calculate total earnings for each company
        $earningsByCompany = $tasks->groupBy('company')->map(function ($tasks) {
            return $tasks->sum('earn');
        });

        // Extract company names as labels and earnings as data
        $labels = $earningsByCompany->keys()->toArray();
        $earnings = $earningsByCompany->values()->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Загальний заробіток',
                    'data' => $earnings,
                ],
            ],
            'labels' => $labels,
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
}
