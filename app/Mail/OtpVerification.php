<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Scalar\String_;
use phpseclib3\Math\PrimeField\Integer;

class OtpVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $otp;
    public function __construct($otp)
    {
        $this->otp= $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail'
            ,

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

    public function build()
    {
        return $this->view('otp_verification')

            ->from('learnyapp9@gmail.com')
            ->subject('OTP Verification');
    }
}
