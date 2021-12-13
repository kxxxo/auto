<?php

namespace App\Services\Notification;

use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class TelegramService
 * @package App\Http\Services
 */
class TelegramService
{
    /**
     * @param $message
     * @return void
     * @throws Exception
     */
    public function sendMessage($message): void
    {
        $url = "https://api.telegram.org/bot" . getenv('SOCIAL_TELEGRAM_BOT_TOKEN') . '/sendMessage';
        $data = [
            'chat_id' => getenv('SOCIAL_TELEGRAM_LOG_CHAT_ID'),
            'text' => $message
        ];
        $response = Http::withOptions([
            'verify' => false,
        ])->post($url, $data);
        if (!$response->ok()) {
            throw new Exception($response->body());
        }
    }
}
