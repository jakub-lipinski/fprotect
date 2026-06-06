<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

class RecaptchaScript
{
    /**
     * @param  array{action?: string}  $configuration
     */
    public function render(array $configuration = []): HtmlString
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
        $fieldName = $this->fieldName();

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

    public function fieldName(): string
    {
        return 'g-recaptcha-response';
    }

    public function ruleName(): string
    {
        return 'recaptcha';
    }
}
