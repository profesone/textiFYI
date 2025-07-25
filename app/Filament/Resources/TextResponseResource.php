<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextResponseResource\Pages;
use App\Filament\Resources\TextResponseResource\RelationManagers;
use App\Models\TextResponse;
use Filament\Forms;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
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
                    ->relationship('dispatch', 'title')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->options(Client::all()
                                ->where('agency_id', '=', auth()->user()->agency_id)
                                ->pluck('user.name', 'id'))
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),   
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
                    ]),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('response')
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
            ->columns([
                Tables\Columns\TextColumn::make('dispatch.client.user.name')
                    ->searchable()
                    ->label('Client')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('dispatch.client.user.name')
                    ->relationship(
                        'dispatch.client.user',
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
            ->defaultGroup('dispatch.client.user.name')
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
