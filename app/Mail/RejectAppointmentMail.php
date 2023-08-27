<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RejectAppointmentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public string $user_name;

    public function __construct($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reject appointment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('reject_appointment')
            ->from('learnyapp9@gmail.com')
            ->subject('Reject appointment');
    }
}
