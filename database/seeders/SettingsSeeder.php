<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'kontakt.phone', 'display_name' => 'Numer telefonu', 'value' => '33 300 32 65', 'type' => 'text', 'order' => 1, 'group' => 'Kontakt'],
            ['key' => 'kontakt.phone2', 'display_name' => 'Dodatkowy numer telefonu', 'value' => '+48 504 483 834', 'type' => 'text', 'order' => 2, 'group' => 'Kontakt'],
            ['key' => 'kontakt.email', 'display_name' => 'Adres email', 'value' => 'biuro@fprotect.pl', 'type' => 'text', 'order' => 3, 'group' => 'Kontakt'],
            ['key' => 'kontakt.email2', 'display_name' => 'Dodatkowy adres email', 'value' => 'leszek@fprotect.pl', 'type' => 'text', 'order' => 4, 'group' => 'Kontakt'],
            ['key' => 'strona.logo', 'display_name' => 'Logo', 'value' => 'settings/January2025/IbO7LdoxrImy2YgoL235.png', 'type' => 'image', 'order' => 1, 'group' => 'Strona'],
            ['key' => 'strona.hero_title', 'display_name' => 'Nagłówek w sekcji pierwszej', 'value' => 'Najwyższa ochrona PPOŻ dla Ciebie', 'type' => 'text', 'order' => 2, 'group' => 'Strona'],
            ['key' => 'strona.hero_text', 'display_name' => 'Tekst w sekcji pierwszej', 'value' => 'Kompleksowa ochrona przeciwpożarowa. Nietypowe wyzwania? Znajdziemy najlepsze rozwiązanie - ekonomiczne i bezpieczne.', 'type' => 'text_area', 'order' => 3, 'group' => 'Strona'],
            ['key' => 'strona.footer_text', 'display_name' => 'Tekst w stopce', 'value' => 'Specjalizujemy się w ochronie przeciwpożarowej, oferując usługi szyte na miarę potrzeb klienta. Rozwiązujemy nawet najbardziej skomplikowane wyzwania, zapewniając ekonomiczne i solidnie udokumentowane systemy bezpieczeństwa.', 'type' => 'text_area', 'order' => 4, 'group' => 'Strona'],
        ];

        foreach ($settings as $setting) {
            Setting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting,
            );
        }
    }
}
