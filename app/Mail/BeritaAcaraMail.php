<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BeritaAcaraMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $beritaAcara;
    public $filename;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, \App\Models\BeritaAcara $beritaAcara, $filename)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->beritaAcara = $beritaAcara;
        $this->filename = $filename;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            htmlString: nl2br(e($this->body)),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(function () {
                $pdfService = app(\App\Services\PdfService::class);
                $this->beritaAcara->load('customer', 'attachments');
                $pdf = $pdfService->generate('pdf.berita-acara', ['beritaAcara' => $this->beritaAcara]);
                return $pdf->output();
            }, $this->filename)->withMime('application/pdf'),
        ];
    }
}