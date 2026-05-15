<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Handle submissions of the public contact form.
 *
 * Validation lives in {@see ContactRequest}. This controller adds an
 * additional rate limit on top of the route-level `throttle` middleware so
 * we are protected even if a deployment forgets the middleware, and logs
 * every accepted request for audit purposes.
 */
class ContactController extends Controller
{
    /**
     * Rate-limit key prefix.
     */
    private const RATE_LIMIT_KEY = 'contact-form';

    /**
     * Maximum number of submissions per IP per hour.
     */
    private const HOURLY_LIMIT = 5;

    /**
     * Handle a contact form submission.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        $key = self::RATE_LIMIT_KEY . ':' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, self::HOURLY_LIMIT)) {
            return back()
                ->withInput()
                ->with('contact_error', 'Příliš mnoho pokusů. Zkuste to prosím za hodinu.');
        }

        RateLimiter::hit($key, decaySeconds: 3600);

        /** @var array{name: string, email: string, phone: ?string, message: string} $data */
        $data = $request->safe()->only(['name', 'email', 'phone', 'message']);

        $recipient = (string) config('mail.contact_recipient', 'franta.rys@gmail.com');

        try {
            Mail::raw(
                "Nová poptávka z webu\n\n" .
                "Jméno: {$data['name']}\n" .
                "E-mail: {$data['email']}\n" .
                'Telefon: ' . ($data['phone'] ?? '-') . "\n\n" .
                "Zpráva:\n{$data['message']}",
                static function ($message) use ($recipient, $data): void {
                    $message->to($recipient)
                        ->subject('Nová poptávka – Rys – Výškové práce')
                        ->replyTo($data['email'], $data['name']);
                },
            );
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', [
                'error' => $e->getMessage(),
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput()
                ->with('contact_error', 'Zprávu se nepodařilo odeslat. Zkuste to prosím znovu.');
        }

        Log::info('Contact form submitted', [
            'email' => $data['email'],
            'ip' => $request->ip(),
        ]);

        return redirect()
            ->to(url('/') . '#contact')
            ->with('contact_success', 'Děkujeme za zprávu, brzy se Vám ozveme.');
    }
}
