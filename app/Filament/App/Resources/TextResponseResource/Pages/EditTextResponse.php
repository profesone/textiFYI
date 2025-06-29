<?php

namespace App\Filament\App\Resources\TextResponseResource\Pages;

use App\Filament\App\Resources\TextResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTextResponse extends EditRecord
{
    protected static string $resource = TextResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
