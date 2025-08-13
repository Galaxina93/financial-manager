<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Str;

class KalkulationEingang extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    protected ?string $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data, ?string $pdfPath = null)
    {
        $this->data = $data;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->data['email'], $this->data['vorname'] . ' ' . $this->data['nachname']),
            subject: 'Neue Kalkulation von ' . $this->data['vorname'] . ' ' . $this->data['nachname'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'global.mails.calculation',
            with: ['data' => $this->data],
        );
    }

    /**
     * Attach the PDF to the email.
     */
    public function attachments(): array
    {
        if ($this->pdfPath && file_exists($this->pdfPath)) {
            // Nachname bereinigen (nur Buchstaben, Bindestriche und Unterstriche)
            $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '', Str::slug($this->data['nachname'] ?? 'anfrage'));

            return [
                Attachment::fromPath($this->pdfPath)
                    ->as("Kalkulation-{$cleanName}.pdf")
                    ->withMime('application/pdf'),
            ];
        }

        return [];
    }


}
