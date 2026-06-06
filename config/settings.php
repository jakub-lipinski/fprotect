<?php

use App\Settings\SiteSettings;
use Spatie\LaravelData\Data;
use Spatie\LaravelSettings\SettingsCasts\DataCast;
use Spatie\LaravelSettings\SettingsCasts\DateTimeInterfaceCast;
use Spatie\LaravelSettings\SettingsCasts\DateTimeZoneCast;
use Spatie\LaravelSettings\SettingsRepositories\DatabaseSettingsRepository;
use Spatie\LaravelSettings\SettingsRepositories\RedisSettingsRepository;

return [
    'settings' => [
        SiteSettings::class,
    ],

    'setting_class_path' => app_path('Settings'),

    'migrations_paths' => [
        database_path('settings'),
    ],

    'default_repository' => 'database',

    'repositories' => [
        'database' => [
            'type' => DatabaseSettingsRepository::class,
            'model' => null,
            'table' => 'spatie_settings',
            'connection' => null,
        ],
        'redis' => [
            'type' => RedisSettingsRepository::class,
            'connection' => null,
            'prefix' => null,
        ],
    ],

    'encoder' => null,
    'decoder' => null,

    'cache' => [
        'enabled' => (bool) env('SETTINGS_CACHE_ENABLED', false),
        'store' => null,
        'prefix' => null,
        'ttl' => null,
        'memo' => env('SETTINGS_CACHE_MEMO', false),
    ],

    'global_casts' => [
        DateTimeInterface::class => DateTimeInterfaceCast::class,
        DateTimeZone::class => DateTimeZoneCast::class,
        Data::class => DataCast::class,
    ],

    'auto_discover_settings' => [
        app_path('Settings'),
    ],

    'discovered_settings_cache_path' => base_path('bootstrap/cache'),

    'fallbacks' => [
        'phone' => '33 300 32 65',
        'secondary_phone' => '+48 504 483 834',
        'email' => 'biuro@fprotect.pl',
        'secondary_email' => 'leszek@fprotect.pl',
        'logo' => 'settings/January2025/IbO7LdoxrImy2YgoL235.png',
        'hero_title' => 'Najwyższa ochrona PPOŻ dla Ciebie',
        'hero_text' => 'Kompleksowa ochrona przeciwpożarowa. Nietypowe wyzwania? Znajdziemy najlepsze rozwiązanie - ekonomiczne i bezpieczne.',
        'footer_text' => 'Specjalizujemy się w ochronie przeciwpożarowej, oferując usługi szyte na miarę potrzeb klienta. Rozwiązujemy nawet najbardziej skomplikowane wyzwania, zapewniając ekonomiczne i solidnie udokumentowane systemy bezpieczeństwa.',
    ],
];
