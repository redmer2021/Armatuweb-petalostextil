<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmarVenta extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $productos;
    public $nroVenta;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $productos, $nroVenta)
    {
        $this->nombre = $name;
        $this->productos = $productos;
        $this->nroVenta = $nroVenta;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pétalos Textil - Confirmación de Venta',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmar_venta',
            with: [
                'nombre' => $this->nombre,
                'productos' => $this->productos,
                'nroVenta' => $this->nroVenta
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
