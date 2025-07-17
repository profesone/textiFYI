<?php

namespace App\Filament\Resources\DispatchResource\Widgets;

use App\Models\Dispatch;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DispatchOverview extends BaseWidget
{
    private function getTotals(): array
    {
        $data = [
            'active' => Dispatch::where('active', true)->count(),
            'inactive' => Dispatch::where('active', false)->count(),
        ];

        $data['total'] = $data['active'] + $data['inactive'];

        return $data;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Active Dispatches', $this->getTotals()['active']),
            Stat::make('Inactive Dispatches', $this->getTotals()['inactive']),
            Stat::make('Total Dispatches', $this->getTotals()['total']),            
        ];
    }
}
