<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Support\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function send(Request $request, Recaptcha $recaptcha)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'message' => 'required',
            'privacy_policy' => 'accepted',
            recaptchaFieldName() => 'nullable|string',
        ]);

        if (! $recaptcha->passes($data[recaptchaFieldName()] ?? null, $request->ip())) {
            throw ValidationException::withMessages([
                recaptchaFieldName() => 'Nie udało się potwierdzić zabezpieczenia reCAPTCHA. Spróbuj ponownie.',
            ]);
        }

        unset($data[recaptchaFieldName()]);

        Mail::to('j.lipinski017@gmail.com')->send(new ContactMail($data));

        return redirect()->back()->with('success', 'Dziękujemy za wiadomość. Zwykle odpowiadamy w ciągu dwóch dni roboczych.');
    }
}
