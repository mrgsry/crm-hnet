<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');
        $this->url = env('FONNTE_URL', 'https://api.fonnte.com/send');
    }

    /**
     * Send WhatsApp message
     */
    public function sendMessage($to, $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->url, [
                'target' => $to,
                'message' => $message,
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('WhatsApp Error: ' . $e->getMessage());
            return ['status' => false, 'reason' => $e->getMessage()];
        }
    }

    /**
     * Send WhatsApp with file link (Fonnte supports link)
     */
    public function sendWithFile($to, $message, $fileUrl)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->url, [
                'target' => $to,
                'message' => $message,
                'url' => $fileUrl,
            ]);

            return $response->json();
        } catch (\Exception $e) {
            Log::error('WhatsApp Error: ' . $e->getMessage());
            return ['status' => false, 'reason' => $e->getMessage()];
        }
    }
}