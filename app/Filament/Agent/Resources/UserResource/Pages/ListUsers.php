<?php

namespace App\Filament\Agent\Resources\UserResource\Pages;

use App\Filament\Agent\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'Agents' => Tab::make()
    //             ->modifyQueryUsing(function (Builder $query) {
    //                 $query->where('roles', 'agent');
    //             }),
    //         'Clients' => Tab::make()
    //             ->modifyQueryUsing(function (Builder $query) {
    //                 $query->where('roles', 'client');
    //             }),
    //     ];
    // }
}
