<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Dispatch;
use App\Models\TextResponse;
use App\Models\TextifyiNumber;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        if (auth()->user()->roles == 'admin') {
            $dashboardStats = [
                Stat::make('Dispatches Needing Approval', fn () => Dispatch::where('active', false)->count()),
                Stat::make('Active Users', fn () => User::where('active', true)->count()),
                Stat::make('Active Dispatches', fn () => Dispatch::where('active', true)->count()),
                Stat::make('Active Text Responses', fn () => TextResponse::where('active', true)->count()),
                Stat::make('Active TextiFYI Numbers', fn () => TextifyiNumber::where('used', true)->count()),
                Stat::make('Available TextiFYI Numbers', fn () => TextifyiNumber::where('used', false)->count()),
                Stat::make('Total Clients', fn () => Client::count()),
            ];
        }
        if (auth()->user()->roles != 'admin') {
            $dashboardStats = [
                Stat::make('Active Users', fn () => User::where('active', true)->where('agency_id', auth()->user()->agency_id)->count()),
                Stat::make('Active Dispatches', fn () => Dispatch::where('active', true)
                    ->whereHas('client', function ($query) {
                        $query->where('agency_id', auth()->user()->agency_id);
                    })
                    ->count()),
                Stat::make('Dispatches Needing Approval', fn () => Dispatch::where('active', false)
                    ->whereHas('client', function ($query) {
                        $query->where('agency_id', auth()->user()->agency_id);
                    })
                    ->count()),
                Stat::make('Active Text Responses', fn () => TextResponse::where('active', true)
                    ->whereHas('dispatch.client', function ($query) {
                        $query->where('agency_id', auth()->user()->agency_id);
                    })
                    ->count()),
                Stat::make('Active TextiFYI Numbers', fn () => TextifyiNumber::where('used', true)
                    ->where('agency_id', auth()->user()->agency_id)
                    ->count()),
                Stat::make('Available TextiFYI Numbers', fn () => TextifyiNumber::where('used', false)
                    ->where('agency_id', auth()->user()->agency_id)
                    ->count()),
                Stat::make('Total Clients', fn () => Client::where('agency_id', auth()->user()->agency_id)->count()),
            ];
        }

        return $dashboardStats;
    }
}
