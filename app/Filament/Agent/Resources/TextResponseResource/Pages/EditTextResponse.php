<?php

namespace App\Filament\Agent\Resources\TextResponseResource\Pages;

use App\Filament\Agent\Resources\TextResponseResource;
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
