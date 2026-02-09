<?php

namespace App\Filament\Agent\Resources\ClientResource\Pages;

use App\Filament\Agent\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Auth\Access\AuthorizationException;

class EditUser extends EditRecord
{
    protected static string $resource = ClientResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        if (!ClientResource::canEdit($this->record)) {
            throw new AuthorizationException('You cannot edit other agents.');
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn () => ClientResource::canDelete($this->record)),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
