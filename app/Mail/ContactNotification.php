<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    /**
     * Inisialisasi data pesan.
     */
    public function __construct(Message $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Mengatur Subjek Email secara dinamis.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan Baru: ' . $this->contactMessage->subject,
        );
    }

    /**
     * Menghubungkan ke file Blade template email yang benar.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-notification',
        );
    }

    /**
     * Jika ada lampiran (kosongkan saja).
     */
    public function attachments(): array
    {
        return [];
    }
}
