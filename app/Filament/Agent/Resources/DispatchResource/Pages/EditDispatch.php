<?php

namespace App\Filament\Agent\Resources\DispatchResource\Pages;

use App\Filament\Agent\Resources\DispatchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDispatch extends EditRecord
{
    protected static string $resource = DispatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
