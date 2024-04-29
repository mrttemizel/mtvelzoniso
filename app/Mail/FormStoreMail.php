<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormStoreMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Antalya Bilim University | Internetional Students Office',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('backend.email.form-store-mail')
            ->with([
                'title' => $this->mail['title'],
                'body1' => $this->mail['body1'],
                'body2' => $this->mail['body2'],
                'body3' => $this->mail['body3'],
            ])
            ->subject('Laravel Email with Array Test');
    }
}
