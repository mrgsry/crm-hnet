<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * Send email with attachment
     */
    public function sendWithAttachment($to, $subject, $body, $attachmentPath, $attachmentName)
    {
        Mail::send([], [], function ($message) use ($to, $subject, $body, $attachmentPath, $attachmentName) {
            $message->to($to)
                ->subject($subject)
                ->html($body)
                ->attach(storage_path('app/public/' . $attachmentPath), [
                    'as' => $attachmentName,
                    'mime' => 'application/pdf',
                ]);
        });
    }

    /**
     * Send simple email
     */
    public function send($to, $subject, $body)
    {
        Mail::send([], [], function ($message) use ($to, $subject, $body) {
            $message->to($to)
                ->subject($subject)
                ->html($body);
        });
    }
}