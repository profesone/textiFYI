<?php

namespace App\Filament\App\Resources\TextifyiNumberResource\Pages;

use App\Filament\App\Resources\TextifyiNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTextifyiNumber extends EditRecord
{
    protected static string $resource = TextifyiNumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
