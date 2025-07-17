<?php

namespace App\Livewire;

use App\Models\Client;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Tables\Table;
use Livewire\Component;

class ClientList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;
    public function mount(): void
    {
        //$this->table->fill();
    }
    
    public function render()
    {
        return view('livewire.client-list');
    }

    public function table(Table $table): Table
    {
        return $table
        ->query(function () {
            return Client::query();
        })
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('deleted_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }
}
