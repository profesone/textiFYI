<?php

namespace App\Filament\Agent\Resources\TextifyiNumberResource\Pages;

use App\Filament\Agent\Resources\TextifyiNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTextifyiNumbers extends ListRecords
{
    protected static string $resource = TextifyiNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
