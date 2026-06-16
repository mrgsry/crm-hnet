<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Models\EmailLog;
use Exception;

class EmailService
{
    /**
     * Send email with attachment
     */
    public function sendWithAttachment($to, $subject, $body, $attachmentPath, $attachmentName)
    {
        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body, $attachmentPath, $attachmentName) {
                $message->to($to)
                    ->subject($subject)
                    ->html($body)
                    ->attach(storage_path('app/public/' . $attachmentPath), [
                        'as' => $attachmentName,
                        'mime' => 'application/pdf',
                    ]);
            });

            EmailLog::create([
                'recipient' => $to,
                'document' => $subject,
                'status' => 'Sent'
            ]);
        } catch (Exception $e) {
            EmailLog::create([
                'recipient' => $to,
                'document' => $subject,
                'status' => 'Failed'
            ]);
            throw $e;
        }
    }

    /**
     * Send simple email
     */
    public function send($to, $subject, $body)
    {
        try {
            Mail::send([], [], function ($message) use ($to, $subject, $body) {
                $message->to($to)
                    ->subject($subject)
                    ->html($body);
            });

            EmailLog::create([
                'recipient' => $to,
                'document' => $subject,
                'status' => 'Sent'
            ]);
        } catch (Exception $e) {
            EmailLog::create([
                'recipient' => $to,
                'document' => $subject,
                'status' => 'Failed'
            ]);
            throw $e;
        }
    }
}