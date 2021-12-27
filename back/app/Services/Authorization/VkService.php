<?php

namespace App\Services\Authorization;

use App\Models\User;
use App\Services\Notification\TelegramService;
use App\Services\Portal\User\ProfileService;
use Exception;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * Class TelegramService
 * @package App\Http\Services
 */
class VkService
{
    private const AUTH_URL = "https://oauth.vk.com/authorize";
    private const ACCESS_TOKEN_URL = "https://oauth.vk.com/access_token";

    /**
     * @var TelegramService
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
     * Information about scope: https://vk.com/dev/permissions
     * @return string
     */
    public function generateUrlForAuth($access_token): string
    {
        return self::AUTH_URL . '?' . http_build_query([
                'client_id' => getenv('SOCIAL_VK_CLIENT_ID'),
                'scope' => 4194304  // email
                    + 65536, // offline
                'redirect_uri' => route('web.auth.vk')
            ]);
    }

    /**
     * @throws Exception
     */
    public function authorize($code, $access_token): User
    {
        $url = self::ACCESS_TOKEN_URL . '?' . http_build_query([
                'client_id' => getenv('SOCIAL_VK_CLIENT_ID'),
                'client_secret' => getenv('SOCIAL_VK_SECRET_KEY'),
                'redirect_uri' => route('web.auth.vk') . "?access_token=" . $access_token,
                'code' => $code
            ]);
        $response = Http::get($url);
        if ($response->ok()) {
            /** @var $user User */
            echo "Find by " . substr($access_token,7) . "<br/>";
            $user = PersonalAccessToken::findToken(substr($access_token,7))->tokenable()->first();
            $access_token = $response->json('access_token');
            $vk_user_id = $response->json('user_id');
            $email = $response->json('email');
            if ($this->check($access_token)) {
                $profile_vk = $this->profileService->connectWithVk($vk_user_id, $access_token, $email, $user);
                return $profile_vk->profile->user;
            }
        } else {
            var_dump($response->json());
        }
        throw new Exception('Authorisation Error');
    }

    /**
     * @throws Exception
     */
    private function check($accessToken): bool
    {
        $url = "https://api.vk.com/method/users.get?" . http_build_query([
                'v' => 5.131,
                'access_token' => $accessToken,
            ]);
        $response = Http::get($url);
        if ($response->ok()) {
            $this->telegram->sendMessage($response->body());
            return true;
        }
        return false;
    }
}
