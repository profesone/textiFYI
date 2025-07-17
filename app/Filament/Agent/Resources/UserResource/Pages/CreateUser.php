<?php

namespace App\Filament\Agent\Resources\UserResource\Pages;

use App\Filament\Agent\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
