<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class Recaptcha
{
    public function passes(?string $token, ?string $ipAddress = null, ?string $action = null): bool
    {
        if (! config('recaptcha.enabled')) {
            return true;
        }

        $secret = config('recaptcha.secret_key');

        if (! $secret) {
            return app()->isLocal();
        }

        if (! $token) {
            return false;
        }

        $response = Http::asForm()
            ->timeout(config('recaptcha.timeout'))
            ->post($this->verifyUrl(), [
                'secret' => $secret,
                'response' => $token,
                'remoteip' => $ipAddress,
            ]);

        if (! $response->ok()) {
            return false;
        }

        $payload = $response->json();

        if (! ($payload['success'] ?? false)) {
            return false;
        }

        if (($payload['score'] ?? 1) < config('recaptcha.min_score')) {
            return false;
        }

        $expectedAction = $action ?? config('recaptcha.action');

        return ! isset($payload['action']) || $payload['action'] === $expectedAction;
    }

    private function verifyUrl(): string
    {
        return sprintf('https://%s/recaptcha/api/siteverify', config('recaptcha.api_domain'));
    }
}
