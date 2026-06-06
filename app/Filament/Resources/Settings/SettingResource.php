<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\Pages\ManageSettings;
use App\Models\Setting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Ustawienia';

    protected static ?string $modelLabel = 'ustawienie';

    protected static ?string $pluralModelLabel = 'ustawienia';

    protected static ?int $navigationSort = 40;

    protected static ?string $recordTitleAttribute = 'display_name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Klucz')
                    ->required(),
                TextInput::make('display_name')
                    ->label('Nazwa')
                    ->required(),
                Textarea::make('value')
                    ->label('Wartość')
                    ->rows(5)
                    ->columnSpanFull(),
                Textarea::make('details')
                    ->label('Szczegóły')
                    ->rows(3)
                    ->columnSpanFull(),
                Select::make('type')
                    ->label('Typ')
                    ->options([
                        'text' => 'Tekst',
                        'text_area' => 'Dłuższy tekst',
                        'image' => 'Obraz / ścieżka pliku',
                    ])
                    ->required()
                    ->native(false),
                TextInput::make('order')
                    ->label('Kolejność')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('group')
                    ->label('Grupa'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('display_name')
            ->columns([
                TextColumn::make('key')
                    ->label('Klucz')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('display_name')
                    ->label('Nazwa')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Typ')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('order')
                    ->label('Kolejność')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('group')
                    ->label('Grupa')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSettings::route('/'),
        ];
    }
}
