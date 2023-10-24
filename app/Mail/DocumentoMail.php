<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $practicantes , public $archivo)
    {
        //variables especificas
    }

    /**
     * Get the message envelope. encabezados
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Documento de Practicas',
            from:new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.doc',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [public_path('/archivos/'.$this->archivo)];
    }
}
