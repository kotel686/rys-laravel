<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Handle submissions of the public contact form.
 *
 * Messages are persisted to the `contact_messages` table and reviewed in the
 * Filament admin panel. No e-mail is sent. The route already carries a
 * `throttle:10,60` middleware; this controller adds a stricter per-IP rate
 * limit (5/hour) as defence-in-depth.
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
     * Store an incoming contact-form submission.
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

        $message = ContactMessage::query()->create([
            'name' => $data['name'],
            'email' => mb_strtolower($data['email']),
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'ip_address' => $request->ip(),
        ]);

        Log::info('Contact message stored', [
            'id' => $message->id,
            'email' => $message->email,
            'ip' => $request->ip(),
        ]);

        return redirect()
            ->to(url('/') . '#contact')
            ->with('contact_success', 'Děkujeme za zprávu, brzy se Vám ozveme.');
    }
}
