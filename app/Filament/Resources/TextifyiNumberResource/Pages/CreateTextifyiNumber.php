<?php

namespace App\Filament\Resources\TextifyiNumberResource\Pages;

use App\Filament\Resources\TextifyiNumberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTextifyiNumber extends CreateRecord
{
    protected static string $resource = TextifyiNumberResource::class;

    protected function getRedirectUrl(): string 
    { 
        return $this->getResource()::getUrl('index'); 
    } 
}
