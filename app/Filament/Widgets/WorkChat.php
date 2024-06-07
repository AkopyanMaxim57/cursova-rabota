<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use App\Models\Tasks; // Import the Task model
use Illuminate\Support\Facades\DB; // Import the DB facade


class WorkChat extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Кількість замовлень';

    protected function getData(): array
    {
        // Get the current year
        // Get the current year
        $currentYear = Carbon::now()->year;

        // Get the count of tasks grouped by month
        $tasksCountByMonth = Tasks::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Initialize an array with 12 months filled with 0
        $data = array_fill(1, 12, 0);

        // Populate the data array with actual counts
        foreach ($tasksCountByMonth as $month => $count) {
            $data[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Замовлення протягом року',
                    'data' => array_values($data), // Ensure the data is ordered by month
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
