<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Notification mail sent to the operator whenever a public contact form
 * (Výškové práce or Lezecká stěna) is submitted.
 *
 * Reply-To header is set to the visitor's e-mail so the operator can
 * just hit reply in their inbox.
 */
class ContactMessageNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new mailable for the given stored contact message.
     */
    public function __construct(public readonly ContactMessage $message)
    {
        //
    }

    /**
     * Build the envelope.
     */
    public function envelope(): Envelope
    {
        $sourceLabel = $this->message->sourceLabel();

        return new Envelope(
            subject: "Nová zpráva z webu – {$sourceLabel}",
            replyTo: [$this->message->email => $this->message->name],
        );
    }

    /**
     * Build the content.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
            with: [
                'contactMessage' => $this->message,
            ],
        );
    }
}
