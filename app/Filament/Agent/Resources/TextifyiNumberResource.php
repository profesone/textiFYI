<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\TextifyiNumberResource\Pages;
use App\Filament\Agent\Resources\TextifyiNumberResource\RelationManagers;
use App\Models\TextifyiNumber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextifyiNumberResource extends Resource
{
    protected static ?string $model = TextifyiNumber::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-down-left';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('agency_id', auth()->user()->agency_id);
            })
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->numeric()
                    ->label('Number')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('priority')
                    ->options(
                        TextifyiNumber::PRIORITY
                    ),
                Tables\Columns\IconColumn::make('used')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated'),
            ])
            ->filters([
                //
            ],)
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTextifyiNumbers::route('/'),
        ];
    }
}
