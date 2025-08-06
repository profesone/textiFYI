<?php

namespace App\Filament\Agent\Resources\AgencyResource\Pages;

use App\Filament\Agent\Resources\AgencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgencies extends ListRecords
{
    protected static string $resource = AgencyResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
