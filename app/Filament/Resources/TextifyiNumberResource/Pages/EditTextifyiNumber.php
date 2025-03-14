<?php

namespace App\Filament\Resources\TextifyiNumberResource\Pages;

use App\Filament\Resources\TextifyiNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTextifyiNumber extends EditRecord
{
    protected static string $resource = TextifyiNumberResource::class;

    protected function getRedirectUrl(): string 
    { 
        return $this->getResource()::getUrl('index'); 
    } 

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
