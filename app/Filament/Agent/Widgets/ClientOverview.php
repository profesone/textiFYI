<?php

namespace App\Filament\Agent\Widgets;

use App\Models\Client;
use App\Models\Dispatch;
use App\Models\TextResponse;
use App\Models\TextifyiNumber;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClientOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = (auth()->user()->team_id != null) 
            ? User::where('active', true)
                ->where('team_id', auth()->user()->team_id)
                ->count() 
            : "1";

        return [
            Stat::make('Active Users', fn () => $userCount),
            Stat::make('Active Dispatches', fn () => Dispatch::where('active', true)->count()),
            Stat::make('Active Text Responses', fn () => TextResponse::where('active', true)->count()),
            Stat::make('Active TextiFYI Numbers', fn () => TextifyiNumber::where('used', true)->count()),
            Stat::make('Available TextiFYI Numbers', fn () => TextifyiNumber::where('used', false)->count()),
            Stat::make('Total Clients', fn () => Client::count()),
        ];
    }
}
