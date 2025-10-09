<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextResponseResource\Pages;
use App\Filament\Resources\TextResponseResource\RelationManagers;
use App\Models\TextResponse;
use App\Models\User;
use App\Models\TextifyiNumber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextResponseResource extends Resource
{
    protected static ?string $model = TextResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dispatch_id')
                    ->relationship(name: 'dispatch', titleAttribute: 'title')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\Textarea::make('default_message')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('default_request_message')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('default_zipcode_message')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('email_address_response')
                            ->columnSpanFull(),
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
                        Forms\Components\Select::make('textifyi_numbers')
                            ->multiple()
                            ->options(TextifyiNumber::where('used', '=', 1)
                                ->pluck('number', 'id')->toArray())
                            ->columnSpanFull(),
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
                        Forms\Components\TextInput::make('agency_id'),
                        ])
                        ->columnSpanFull(),
                Forms\Components\TextInput::make('title'),
                Forms\Components\Select::make('campaign')
                    ->options(TextResponse::CAMPAIGN)    
                    ->default('keyword'),
                Forms\Components\Textarea::make('response')
                    ->label('Response')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notification_numbers')
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('keywords')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Toggle::make('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dispatch.agency.owner.name')
                    ->hidden()
                    ->searchable(),
                Tables\Columns\TextColumn::make('dispatch.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dispatch.client.name')
                    ->label('Client')
                    ->sortable(),
                Tables\Columns\TextColumn::make('response')
                    ->badge(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('keywords')
                    ->badge(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
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
            ->defaultGroup('dispatch.agency.owner.name')
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
            'index' => Pages\ListTextResponses::route('/'),
            'create' => Pages\CreateTextResponse::route('/create'),
            'edit' => Pages\EditTextResponse::route('/{record}/edit'),
        ];
    }
}
