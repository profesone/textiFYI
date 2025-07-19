<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class UserOverview extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int | string | array $columnSpan = [
        'sm' => 2,
    ];

    private function getMonthlyTotals(): array
    {
        $data = User::selectRaw('COUNT(*) as count, MONTH(created_at) month')
        ->where('created_at', '>=', Carbon::now()->subMonths(12)->startOfMonth())
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        $monthCount = [];

        foreach ($data as $item) {
            $monthCount[date("M", mktime(0, 0, 0, $item->month, 1))] = $item->count;
        }

        return $monthCount;
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Text Responses created',
                    'data' => $this->getMonthlyTotals(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
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
