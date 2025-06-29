<?php

namespace App\Filament\App\Resources\KeywordResource\Pages;

use App\Filament\App\Resources\KeywordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeywords extends ListRecords
{
    protected static string $resource = KeywordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
