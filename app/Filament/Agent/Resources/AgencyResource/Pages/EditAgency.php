<?php

namespace App\Filament\Agent\Resources\AgencyResource\Pages;

use App\Filament\Agent\Resources\AgencyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Auth\Access\AuthorizationException;

class EditAgency extends EditRecord
{
    protected static string $resource = AgencyResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        if (auth()->user()?->roles !== 'lead_agent') {
            throw new AuthorizationException('Only lead agents can edit agencies.');
        }
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
