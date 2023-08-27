<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SessionInfoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $session_id,$name;
    /**
     * Create a new message instance.
     */
    public function __construct($session_id,$name)
    {
        $this->session_id = $session_id;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Session Info Mail',
        );
    }

    /**
     * Get the message content definition.
     */

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('session_info')

            ->from('learnyapp9@gmail.com')
            ->subject('Session info');
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
