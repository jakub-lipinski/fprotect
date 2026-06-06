<?php

namespace App\Filament\Resources\Realizations;

use App\Filament\Resources\Realizations\Pages\ManageRealizations;
use App\Models\Realization;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RealizationResource extends Resource
{
    protected static ?string $model = Realization::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Realizacje';

    protected static ?string $modelLabel = 'realizacja';

    protected static ?string $pluralModelLabel = 'realizacje';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nazwa realizacji')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? '')))
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Krótki opis')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('main_image')
                    ->label('Główne zdjęcie')
                    ->disk('public')
                    ->directory('realizations')
                    ->visibility('public')
                    ->image()
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Dłuższy opis')
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->label('Meta title')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('meta_description')
                    ->label('Meta description')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->label('Meta keywords')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('main_image')
                    ->label('Zdjęcie')
                    ->disk('public')
                    ->visibility('public')
                    ->square(),
                TextColumn::make('name')
                    ->label('Nazwa')
                    ->searchable()
                    ->sortable()
                    ->limit(70),
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
            'index' => ManageRealizations::route('/'),
        ];
    }
}
