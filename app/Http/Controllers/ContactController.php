<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageNotification;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;

/**
 * Handle submissions of the public contact form.
 *
 * Messages are persisted to the `contact_messages` table for the admin
 * panel **and** forwarded by e-mail to the operator (CONTACT_RECIPIENT,
 * falling back to ADMIN_EMAIL). E-mail failures don't fail the request –
 * the row stays in the DB and the visitor still sees the success
 * message; the failure is logged.
 *
 * The route already carries a `throttle:10,60` middleware; this
 * controller adds a stricter per-IP rate limit (5/hour) as
 * defence-in-depth.
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

        /** @var array{name: string, email: string, phone: ?string, message: string, source: ?string} $data */
        $data = $request->safe()->only(['name', 'email', 'phone', 'message', 'source']);

        $source = $data['source'] === ContactMessage::SOURCE_CLIMBING
            ? ContactMessage::SOURCE_CLIMBING
            : ContactMessage::SOURCE_VYSKOVEPRACE;

        $message = ContactMessage::query()->create([
            'name' => $data['name'],
            'email' => mb_strtolower($data['email']),
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'source' => $source,
            'ip_address' => $request->ip(),
        ]);

        Log::info('Contact message stored', [
            'id' => $message->id,
            'email' => $message->email,
            'source' => $source,
            'ip' => $request->ip(),
        ]);

        $this->notifyOperator($message);

        $redirectUrl = $source === ContactMessage::SOURCE_CLIMBING
            ? URL::route('climbing.contact') . '#kontakt-formular'
            : url('/') . '#contact';

        return redirect()
            ->to($redirectUrl)
            ->with('contact_success', 'Děkujeme za zprávu, brzy se Vám ozveme.');
    }

    /**
     * Forward the message to the configured operator inbox(es).
     *
     * Failures (misconfigured SMTP, transient outage, …) are caught and
     * logged so the visitor still gets a successful response and the row
     * stays in the admin panel for manual follow-up.
     */
    private function notifyOperator(ContactMessage $message): void
    {
        $recipients = $this->resolveRecipients();

        if ($recipients === []) {
            Log::warning('Contact message stored but no recipient configured', [
                'id' => $message->id,
            ]);

            return;
        }

        try {
            Mail::to($recipients)->send(new ContactMessageNotification($message));
        } catch (\Throwable $e) {
            Log::error('Contact message notification failed to send', [
                'id' => $message->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Resolve the list of recipients from config, falling back to the
     * admin e-mail when CONTACT_RECIPIENT isn't set. Comma-separated
     * values are supported so multiple people can be notified.
     *
     * @return list<string>
     */
    private function resolveRecipients(): array
    {
        $raw = config('mail.contact_recipient')
            ?? env('CONTACT_RECIPIENT')
            ?? env('ADMIN_EMAIL', '');

        $emails = array_filter(
            array_map('trim', explode(',', (string) $raw)),
            static fn (string $email): bool => $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) !== false,
        );

        return array_values($emails);
    }
}
