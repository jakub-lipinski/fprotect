<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public string $phone;

    public string $secondary_phone;

    public string $email;

    public string $secondary_email;

    public string $logo;

    public string $hero_title;

    public string $hero_text;

    public string $footer_text;

    public static function group(): string
    {
        return 'site';
    }
}
