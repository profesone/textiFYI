<?php

namespace App\Filament\Resources\TextResponseResource\Widgets;

use App\Models\TextResponse;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class TextResponseOverview extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int | string | array $columnSpan = [
        'sm' => 2,
        'md' => 2,
        'lg' => 1,
    ];

    private function getMonthlyTotals(): array
    {
        $data = TextResponse::selectRaw('COUNT(*) as count, YEAR(created_at) year, MONTH(created_at) month')
        ->where('created_at', '>=', Carbon::now()->subMonths(12)->startOfMonth())
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $monthCount = [];

        foreach ($data as $item) {
            $monthCount[$item->month] = $item->count;
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
