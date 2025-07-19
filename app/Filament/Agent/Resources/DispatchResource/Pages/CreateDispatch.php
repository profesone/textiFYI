<?php

namespace App\Filament\Agent\Resources\DispatchResource\Pages;

use App\Filament\Agent\Resources\DispatchResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDispatch extends CreateRecord
{
    protected static string $resource = DispatchResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
