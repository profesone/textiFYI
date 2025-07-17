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
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('used')
                    ->required(),
                Forms\Components\Select::make('dispatch_id')
                    ->relationship('dispatch', 'title')
                    ->default(null),
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'id')
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->numeric()
                    ->label('Number')
                    ->searchable(),
                Tables\Columns\IconColumn::make('used')
                    ->boolean(),
                Tables\Columns\TextColumn::make('dispatch.title')
                    ->numeric()
                    ->label('Dispatch')
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.id')
                    ->numeric()
                    ->label('Client')
                    ->sortable(),
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
            ],)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
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
