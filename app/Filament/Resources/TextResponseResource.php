<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextResponseResource\Pages;
use App\Filament\Resources\TextResponseResource\RelationManagers;
use App\Models\TextResponse;
use App\Models\User;
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
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->placeholder('Example: ' . date('Y') . ' Summer Apple Convention'),
                Forms\Components\Select::make('dispatch_id')
                    ->relationship(name: 'dispatch', titleAttribute: 'title')
                    ->createOptionForm([
                        Forms\Components\Textarea::make('title')->required()
                            ->placeholder('Example: ' . date('Y') . ' Apple Convention'),
                        Forms\Components\Select::make('agent_id')
                            ->label('Agent')
                            ->options(User::where('team_id', Auth()->user()->team_id)->pluck('name', 'id')),
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
                    ])
                    ->required(),
                Forms\Components\Textarea::make('question'),
                Forms\Components\Textarea::make('response'),
                Forms\Components\Textarea::make('notes'),
                Forms\Components\TagsInput::make('notification_numbers'),
                Forms\Components\TagsInput::make('keywords'),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Toggle::make('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('keywords')
                    ->badge(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dispatch.company.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultGroup('dispatch.company.name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
