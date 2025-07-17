<?php

namespace App\Filament\Resources\TextifyiNumberResource\Pages;

use App\Filament\Resources\TextifyiNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTextifyiNumbers extends ListRecords
{
    protected static string $resource = TextifyiNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TextifyiNumberResource\Widgets\TextifyiNumberOverview::class,
        ];
    }
}
