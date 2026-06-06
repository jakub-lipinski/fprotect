<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.phone', $this->oldSetting('kontakt.phone', 'phone'));
        $this->migrator->add('site.secondary_phone', $this->oldSetting('kontakt.phone2', 'secondary_phone'));
        $this->migrator->add('site.email', $this->oldSetting('kontakt.email', 'email'));
        $this->migrator->add('site.secondary_email', $this->oldSetting('kontakt.email2', 'secondary_email'));
        $this->migrator->add('site.logo', $this->oldSetting('strona.logo', 'logo'));
        $this->migrator->add('site.hero_title', $this->oldSetting('strona.hero_title', 'hero_title'));
        $this->migrator->add('site.hero_text', $this->oldSetting('strona.hero_text', 'hero_text'));
        $this->migrator->add('site.footer_text', $this->oldSetting('strona.footer_text', 'footer_text'));
    }

    public function down(): void
    {
        $this->migrator->deleteIfExists('site.phone');
        $this->migrator->deleteIfExists('site.secondary_phone');
        $this->migrator->deleteIfExists('site.email');
        $this->migrator->deleteIfExists('site.secondary_email');
        $this->migrator->deleteIfExists('site.logo');
        $this->migrator->deleteIfExists('site.hero_title');
        $this->migrator->deleteIfExists('site.hero_text');
        $this->migrator->deleteIfExists('site.footer_text');
    }

    private function oldSetting(string $key, string $fallbackKey): string
    {
        if (Schema::hasTable('settings')) {
            $value = DB::table('settings')
                ->where('key', $key)
                ->value('value');

            if (filled($value)) {
                return (string) $value;
            }
        }

        return config("settings.fallbacks.{$fallbackKey}");
    }
};
