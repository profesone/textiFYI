<?php

namespace App\Filament\App\Resources\KeywordResource\Pages;

use App\Filament\App\Resources\KeywordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKeyword extends EditRecord
{
    protected static string $resource = KeywordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
