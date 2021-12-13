<?php

namespace App\Services\Authorization;

use App\Models\User;
use App\Services\Portal\User\ProfileService;
use Exception;

/**
 * Class TelegramService
 * @package App\Http\Services
 */
class TelegramService
{
    private const WIDGET = '<script async src="https://telegram.org/js/telegram-widget.js?15"
        data-telegram-login="KxxoBot" data-size="small" data-userpic="false"
        data-auth-url="https://api.auto.kxxo.ru/auth/tg"
        data-request-access="write"></script>';

    /**
     * @var \App\Services\Notification\TelegramService
     */
    protected $telegram;
    /**
     * @var ProfileService
     */
    private $profileService;

    /**
     * VkService constructor.
     * @param TelegramService $telegram
     * @param ProfileService $profileService
     */
    public function __construct(TelegramService $telegram, ProfileService $profileService)
    {
        $this->telegram = $telegram;
        $this->profileService = $profileService;
    }


    /**
     * @throws Exception
     */
    public function authorize($data): User
    {
        $tg_id = $data['id'];
        $tg_first_name = $data["first_name"];
        $tg_last_name = $data["last_name"];
        $tg_username = $data["username"];
        $tg_photo_url = $data["photo_url"];

        if ($this->check($data)) {
            $profile_vk = $this->profileService->connectWithTelegram(
                $tg_id,
                $tg_first_name,
                $tg_last_name,
                $tg_username,
                $tg_photo_url
            );
            return $profile_vk->profile->user;
        }
        throw new Exception('Authorisation Error');
    }

    /**
     * @param $auth_data
     * @return bool
     * @throws Exception
     */
    private function check($auth_data): bool
    {
        $check_hash = $auth_data['hash'];
        unset($auth_data['hash']);
        $data_check_arr = [];
        foreach ($auth_data as $key => $value) {
            $data_check_arr[] = $key . '=' . $value;
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        $secret_key = hash('sha256', getenv('SOCIAL_TELEGRAM_BOT_TOKEN'), true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);
        if (strcmp($hash, $check_hash) !== 0) {
            throw new Exception('Data is NOT from Telegram');
        }
        if ((time() - $auth_data['auth_date']) > 86400) {
            throw new Exception('Data is outdated');
        }
        return true;
    }
}
