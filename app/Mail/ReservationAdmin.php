<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $data = [];
    public $subject = "Nouvelle réservation";
    /**
     * Create a new message instance.
     */
    public function __construct($reservationMailable)
    {
        $this->data = $reservationMailable;

        if($this->data['status'] == 1) {
            $this->subject = "Nouvelle réservation";
        } else {
            $this->subject = "Réservation en attente";
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservation.markdown-reservation-admin',
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
