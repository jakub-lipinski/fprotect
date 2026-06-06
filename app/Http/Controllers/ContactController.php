<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Support\Recaptcha;
use App\Support\RecaptchaScript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function send(Request $request, Recaptcha $recaptcha, RecaptchaScript $recaptchaScript)
    {
        $recaptchaField = $recaptchaScript->fieldName();

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'message' => 'required',
            'privacy_policy' => 'accepted',
            $recaptchaField => 'nullable|string',
        ]);

        if (! $recaptcha->passes($data[$recaptchaField] ?? null, $request->ip())) {
            throw ValidationException::withMessages([
                $recaptchaField => 'Nie udało się potwierdzić zabezpieczenia reCAPTCHA. Spróbuj ponownie.',
            ]);
        }

        unset($data[$recaptchaField]);

        Mail::to('j.lipinski017@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Dziękujemy za wiadomość. Zwykle odpowiadamy w ciągu dwóch dni roboczych.');
    }
}
