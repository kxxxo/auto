<?php

namespace App\Services\Notification;

use Exception;
use Illuminate\Support\Facades\Http;

/**
 * Class TelephoneService
 * @package App\Http\Services
 */
class TelephoneService
{
    /**
     * @param $telephone
     * @param $message
     * @return bool
     * @throws Exception
     */
    public function sendMessage($telephone, $message): bool
    {
        $response = Http::get('http://smsc.ru/sys/send.php?' . http_build_query([
                'login' => getenv('SOCIAL_SMS_LOGIN'),
                'psw' => getenv('SOCIAL_SMS_PASSWORD'),
                'phones' => $telephone,
                'mes' => $message
            ]));
        if ($response->ok()) {
            return true;
        } else {
            throw new Exception("Ошибка отправки смс");
        }
    }
}
