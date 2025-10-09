<?php

namespace App\Filament\Agent\Resources\DispatchResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'textResponses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('response')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title'),
                Forms\Components\Select::make('campagin')
                    ->options(
                        TextResponse::CAMPAIGN
                    ),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('notification_numbers'),
                Forms\Components\TagsInput::make('keywords'),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('response')
            ->columns([
                Tables\Columns\TextColumn::make('response')
                    ->badge(),
                Tables\Columns\TextColumn::make('keywords')
                    ->badge(),
                Tables\Columns\TextColumn::make('notification_numbers')
                    ->badge(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\CheckboxColumn::make('active'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
