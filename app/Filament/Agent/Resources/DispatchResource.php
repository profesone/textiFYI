<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\DispatchResource\Pages;
use App\Filament\Agent\Resources\DispatchResource\RelationManagers;
use App\Models\Dispatch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DispatchResource extends Resource
{
    protected static ?string $model = Dispatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-out';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
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
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereHas('client', function ($query) {
                    $query->where('agency_id', auth()->user()->agency_id);
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.user.name')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('default_messages_module'),
                Tables\Columns\ToggleColumn::make('default_message_notification'),
                Tables\Columns\ToggleColumn::make('default_message_response'),
                Tables\Columns\ToggleColumn::make('publish_keywords_module'),
                Tables\Columns\ToggleColumn::make('leads_module'),
                Tables\Columns\ToggleColumn::make('keyword_module'),
                Tables\Columns\ToggleColumn::make('mls_listing_module'),
                Tables\Columns\ToggleColumn::make('mls_agent_notification'),
                Tables\Columns\ToggleColumn::make('tips_request_module'),
                Tables\Columns\ToggleColumn::make('zip_code_module'),
                Tables\Columns\ToggleColumn::make('default_zip_notification'),
                Tables\Columns\ToggleColumn::make('email_address_module'),
                Tables\Columns\ToggleColumn::make('default_email_notification'),
                Tables\Columns\ToggleColumn::make('active'),
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
                SelectFilter::make('client.user.name')
                    ->relationship(
                        'client.user',
                        'name',
                        fn (Builder $query) => $query
                            ->where('agency_id', auth()->user()->agency_id)
                            ->where('roles', 'client')
                    )
                    ->label('Client')
                    ->searchable()
                    ->preload()
            ], layout: FiltersLayout::AboveContent)
            ->defaultGroup('client.user.name')
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
