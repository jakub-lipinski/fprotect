<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\HtmlString;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        $fallback = config("settings.defaults.{$key}", $default);

        try {
            if (! Schema::hasTable('settings')) {
                return $fallback;
            }

            return Cache::rememberForever("settings.{$key}", function () use ($key, $fallback) {
                return Setting::query()->where('key', $key)->value('value') ?? $fallback;
            });
        } catch (Throwable) {
            return $fallback;
        }
    }
}

if (! function_exists('recaptchaFieldName')) {
    function recaptchaFieldName(): string
    {
        return 'g-recaptcha-response';
    }
}

if (! function_exists('recaptchaRuleName')) {
    function recaptchaRuleName(): string
    {
        return 'recaptcha';
    }
}

if (! function_exists('htmlScriptTagJsApi')) {
    function htmlScriptTagJsApi(array $configuration = []): HtmlString
    {
        if (! config('recaptcha.enabled')) {
            return new HtmlString('');
        }

        $siteKey = config('recaptcha.site_key');

        if (! $siteKey) {
            return new HtmlString('');
        }

        $action = $configuration['action'] ?? config('recaptcha.action');
        $domain = config('recaptcha.api_domain');
        $fieldName = recaptchaFieldName();

        return new HtmlString(<<<HTML
<script src="https://{$domain}/recaptcha/api.js?render={$siteKey}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (! window.grecaptcha) {
        return;
    }

    grecaptcha.ready(function () {
        document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(function (form) {
            let input = form.querySelector('input[name="{$fieldName}"]');

            if (! input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = '{$fieldName}';
                form.appendChild(input);
            }

            const refreshToken = function () {
                return grecaptcha.execute('{$siteKey}', { action: '{$action}' }).then(function (token) {
                    input.value = token;
                });
            };

            refreshToken();
        });
    });
});
</script>
HTML);
    }
}
