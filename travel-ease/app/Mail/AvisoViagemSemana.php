<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Log as FacadesLog;

class AvisoViagemSemana extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $destino;
    public $checkin;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($nome, $destino, $checkin, $pdfPath)
    {
        $this->nome = $nome;
        $this->destino = $destino;
        $this->checkin = $checkin;
        $this->pdfPath = $pdfPath;
        FacadesLog::info('Dados no construtor do Mailable:', ['nome' => $nome, 'destino' => $destino, 'checkin' => $checkin, 'pdfPath' => $pdfPath]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('travelease.ag@gmail.com', 'TravelEase'),
            subject: 'Aviso: Sua viagem está próxima',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.aviso',
            with: [
                'nome' => $this->nome,
                'destino' => $this->destino,
                'checkin' => $this->checkin,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments()
    {
        return $this->pdfPath
        ? [Attachment::fromPath($this->pdfPath)->as('passagens.pdf')->withMime('application/pdf')]
        : [];
    }
}
