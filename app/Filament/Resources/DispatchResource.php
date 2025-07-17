<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DispatchResource\Pages;
use App\Filament\Resources\DispatchResource\RelationManagers;
use App\Models\Dispatch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('default_messages_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('default_message_notification')
                    ->boolean(),
                Tables\Columns\IconColumn::make('default_message_response')
                    ->boolean(),
                Tables\Columns\IconColumn::make('publish_keywords_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('leads_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('keyword_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('mls_listing_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('mls_agent_notification')
                    ->boolean(),
                Tables\Columns\IconColumn::make('tips_request_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('zip_code_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('default_zip_notification')
                    ->boolean(),
                Tables\Columns\IconColumn::make('email_address_module')
                    ->boolean(),
                Tables\Columns\IconColumn::make('default_email_notification')
                    ->boolean(),
                Tables\Columns\TextColumn::make('client.id')
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

    public static function getRelations(): array
    {
        return [
            //
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
