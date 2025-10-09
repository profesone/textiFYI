<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DispatchResource\Pages;
use App\Filament\Resources\DispatchResource\RelationManagers;
use App\Filament\Resources\DispatchResource\RelationManagers\TextResponsesRelationManager;
use App\Models\Agency;
use App\Models\Dispatch;
use App\Models\TextifyiNumber;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DispatchResource extends Resource
{
    protected static ?string $model = Dispatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Client')
                    ->options(User::where('roles', '=', 'client')
                        ->pluck('name', 'id'))
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, ?int $state) {
                        if ($state) {
                            $set('agency_id', User::find($state)->agency_id);
                        }
                    }),
                Forms\Components\Select::make('agency_id')
                    ->options(
                        Agency::pluck('name', 'id')->toArray()
                    ),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Select::make('textifyi_numbers')
                    ->multiple()
                    ->options(TextifyiNumber::where('used', '=', 0)
                        ->pluck('number', 'id')
                        ->toArray()
                    ),
                Forms\Components\Textarea::make('default_message'),
                Forms\Components\Textarea::make('default_request_message'),
                Forms\Components\Textarea::make('default_zipcode_message'),
                Forms\Components\Textarea::make('email_address_response'),
                Forms\Components\Toggle::make('default_messages_module'),
                Forms\Components\Toggle::make('default_message_notification'),
                Forms\Components\Toggle::make('default_message_response'),
                Forms\Components\Toggle::make('publish_keywords_module'),
                Forms\Components\Toggle::make('leads_module'),
                Forms\Components\Toggle::make('keyword_module'),
                Forms\Components\Toggle::make('mls_listing_module'),
                Forms\Components\Toggle::make('mls_agent_notification'),
                Forms\Components\Toggle::make('tips_request_module'),
                Forms\Components\Toggle::make('zip_code_module'),
                Forms\Components\Toggle::make('default_zip_notification'),
                Forms\Components\Toggle::make('email_address_module'),
                Forms\Components\Toggle::make('default_email_notification'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),                
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('active'),
                Tables\Columns\TextColumn::make('textifyi_numbers')
                    ->badge()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return TextifyiNumber::where('id', $state)
                            ->pluck('number')
                            ->toArray()[0];
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('is_featured')
                    ->query(fn (Builder $query): Builder => $query->where('active', false))
                    ->toggle()
                    ->label('Needs Approval')
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultGroup('agency.owner.name')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TextResponsesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDispatches::route('/'),
            'create' => Pages\CreateDispatch::route('/create'),
            'edit' => Pages\EditDispatch::route('/{record}/edit'),
        ];
    }
}
