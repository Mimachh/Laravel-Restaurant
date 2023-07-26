<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Reservationreponse extends Mailable
{
    use Queueable, SerializesModels;
    public $reservation = [];
    public $scenario = "";
    public $urlDuSite = "";
    public $telephoneResto = "";

    /**
     * Create a new message instance.
     */
    public function __construct($reservationMailable, $scenario)
    {
        $this->reservation = $reservationMailable;
        $this->scenario = $scenario;

        $this->urlDuSite = env('APP_URL', 'http://127.0.0.1:8000');
        $this->telephoneResto = env('TEL_ADMIN', "0202020202");
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre réservation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservation.markdown-reservation-reponse-public',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
