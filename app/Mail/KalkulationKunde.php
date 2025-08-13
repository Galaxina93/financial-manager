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

class KalkulationKunde extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    protected string $pdfPath;

    /**
     * @param array $data - Die übermittelten Formulardaten
     * @param string $pdfPath - Der absolute Pfad zur generierten PDF
     */
    public function __construct(array $data, string $pdfPath)
    {
        $this->data = $data;
        $this->pdfPath = $pdfPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS', 'alina@steinhauer.de'), 'Felix-Machts'),
            replyTo: [new Address(env('MAIL_FROM_ADDRESS', 'alina@steinhauer.de'), 'Felix-Machts')],
            subject: 'Ihre Kalkulationsanfrage bei ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'global.mails.calculation_customer',
            with: ['data' => $this->data],
        );
    }

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
