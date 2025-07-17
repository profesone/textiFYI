<?php

namespace App\Filament\Agent\Resources\TextResponseResource\Pages;

use App\Filament\Agent\Resources\TextResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTextResponses extends ListRecords
{
    protected static string $resource = TextResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
