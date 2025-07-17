<?php

namespace App\Filament\Resources\TextifyiNumberResource\Widgets;

use App\Models\TextifyiNumber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TextifyiNumberOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active TextiFYI Numbers', fn () => TextifyiNumber::where('used', true)->count()),
            Stat::make('Inactive TextiFYI Numbers', fn () => TextifyiNumber::where('used', false)->count()),
            Stat::make('Total TextiFYI Numbers', fn () => TextifyiNumber::count()),            
        ];
    }
}
