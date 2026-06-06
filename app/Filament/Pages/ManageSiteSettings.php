<?php

namespace App\Filament\Pages;

use App\Settings\SiteSettings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSiteSettings extends SettingsPage
{
    protected static string $settings = SiteSettings::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Ustawienia';

    protected static ?string $title = 'Ustawienia';

    protected static ?string $slug = 'ustawienia';

    protected static UnitEnum|string|null $navigationGroup = null;

    protected static ?int $navigationSort = 40;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Strona')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                        TextInput::make('hero_title')
                            ->label('Nagłówek w sekcji pierwszej')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('hero_text')
                            ->label('Tekst w sekcji pierwszej')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('footer_text')
                            ->label('Tekst w stopce')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('Kontakt')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Numer telefonu')
                            ->tel()
                            ->required(),
                        TextInput::make('secondary_phone')
                            ->label('Dodatkowy numer telefonu')
                            ->tel()
                            ->required(),
                        TextInput::make('email')
                            ->label('Adres email')
                            ->email()
                            ->required(),
                        TextInput::make('secondary_email')
                            ->label('Dodatkowy adres email')
                            ->email()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['logo'] = $this->normalizeUploadedValue($data['logo'] ?? null);

        return $data;
    }

    private function normalizeUploadedValue(mixed $value): string
    {
        if (is_array($value)) {
            $value = collect($value)
                ->filter(fn (mixed $path): bool => filled($path))
                ->first();
        }

        return filled($value) ? (string) $value : config('settings.fallbacks.logo');
    }
}
