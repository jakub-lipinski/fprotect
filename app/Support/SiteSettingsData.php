<?php

namespace App\Support;

use App\Settings\SiteSettings;
use Illuminate\Support\Facades\Storage;

class SiteSettingsData
{
    public function __construct(
        public string $phone,
        public string $secondaryPhone,
        public string $email,
        public string $secondaryEmail,
        public string $logo,
        public string $heroTitle,
        public string $heroText,
        public string $footerText,
    ) {}

    public static function fromSettings(?SiteSettings $settings = null): self
    {
        $fallbacks = config('settings.fallbacks');

        return new self(
            phone: $settings?->phone ?: $fallbacks['phone'],
            secondaryPhone: $settings?->secondary_phone ?: $fallbacks['secondary_phone'],
            email: $settings?->email ?: $fallbacks['email'],
            secondaryEmail: $settings?->secondary_email ?: $fallbacks['secondary_email'],
            logo: $settings?->logo ?: $fallbacks['logo'],
            heroTitle: $settings?->hero_title ?: $fallbacks['hero_title'],
            heroText: $settings?->hero_text ?: $fallbacks['hero_text'],
            footerText: $settings?->footer_text ?: $fallbacks['footer_text'],
        );
    }

    public function logoUrl(string $fallback = 'img/logo.png'): string
    {
        $path = $this->logo;

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        if ($path !== '' && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        return asset($fallback);
    }
}
