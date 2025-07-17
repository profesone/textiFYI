<?php

namespace App\Filament\Agent\Resources\TextResponseResource\Pages;

use App\Filament\Agent\Resources\TextResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTextResponse extends CreateRecord
{
    protected static string $resource = TextResponseResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
