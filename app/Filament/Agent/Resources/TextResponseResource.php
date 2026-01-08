<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\TextResponseResource\Pages;
use App\Filament\Agent\Resources\TextResponseResource\RelationManagers;
use App\Models\Agency;
use App\Models\TextifyiNumber;
use App\Models\TextResponse;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextResponseResource extends Resource
{
    protected static ?string $model = TextResponse::class;

    protected static bool $shouldRegisterNavigation = false;

    // protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dispatch_id')
                    ->relationship('dispatch', 'title')
                    ->createOptionForm([
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
                        Forms\Components\Hidden::make('agency_id')
                            ->default(auth()->user()->agency_id),
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\Select::make('textifyi_numbers')
                            ->multiple()
                            ->options(TextifyiNumber::where('used', '=', 0)
                                ->where('agency_id', auth()->user()->agency_id)
                                ->pluck('number')
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
                    ])
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('response')
                    ->required()
                    ->columnSpanFull(),
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

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('dispatch.client', function ($query) {
                    $query->where('agency_id', auth()->user()->agency_id);
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('dispatch.client.user.name')
                    ->searchable()
                    ->label('Client')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->url(fn (TextResponse $record) => DispatchResource::getUrl('edit', ['record' => $record->dispatch])),
                Tables\Columns\TextColumn::make('dispatch.title')
                    ->searchable()
                    ->sortable(),
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
                Tables\Columns\ToggleColumn::make('active'),
                Tables\Columns\TextColumn::make('notes')
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
                SelectFilter::make('dispatch.client.name')
                    ->relationship(
                        'dispatch.client',
                        'name',
                        fn (Builder $query) => $query
                            ->where('agency_id', auth()->user()->agency_id)
                            ->where('roles', 'client')
                    )
                    ->label('Clients')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultGroup('dispatch.client.name')
            // ->defaultGroup('dispatch.user.name')
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
