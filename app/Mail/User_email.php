<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class User_email extends Mailable
{
    use Queueable, SerializesModels;

    private array $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Answer '.$this->message['title'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.answer_email',
            with: [
                'title' => $this->message['title'],
                'content' => $this->message['content'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
