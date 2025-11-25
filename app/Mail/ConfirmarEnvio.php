<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmarEnvio extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $msgComprador;
    public $linkSeguimiento;

    /**
     * Create a new message instance.
     */
    public function __construct($nombre, $msgComprador, $linkSeguimiento)
    {
        $this->nombre = $nombre;
        $this->msgComprador = $msgComprador;
        $this->linkSeguimiento = $linkSeguimiento;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pétalos Textil - Tu compra ya está en viaje',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmar_envio',
            with: [
                'nombre' => $this->nombre,
                'msgComprador' => $this->msgComprador,
                'linkSeguimiento' => $this->linkSeguimiento,
            ],
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
