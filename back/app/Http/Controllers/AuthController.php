<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Authorization\TelegramService;
use App\Services\Authorization\TelephoneService;
use App\Services\Authorization\VkService;
use App\Services\Authorization\EmailService;
use Exception;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /** @var VkService */
    protected $vkService;
    /** @var TelegramService */
    protected $telegramService;
    /** @var TelephoneService */
    protected $telephoneService;
    /** @var EmailService */
    protected $emailService;

    public function __construct(
        VkService $vkService,
        TelegramService $telegramService,
        TelephoneService $telephoneService,
        EmailService $emailService
    ) {
        $this->vkService = $vkService;
        $this->telegramService = $telegramService;
        $this->telephoneService = $telephoneService;
        $this->emailService = $emailService;
    }

    /**
     * @throws Exception
     */
    public function vk(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string',
            'access_token' => 'required|string'
        ]);
        $user = $this->vkService->authorize($data['code'],$data['access_token']);
        $user_token = $user->createToken('token')->plainTextToken;
        return redirect(
            sprintf(
                "%s/authorization/%s",
                getenv('FRONTEND_APP_URL'),
                $user_token
            )
        );
    }

    /**
     * @throws Exception
     */
    public function tg(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
            'first_name' => 'string',
            'last_name' => 'string',
            'username' => 'required|string',
            'photo_url' => 'string',
            'auth_date' => 'required|string',
            'hash' => 'required|string',
            'access_token' => 'required|string'
        ]);
        $access_token = $data['access_token'];
        unset($data['access_token']);
        $user = null;
        if($access_token) {
            /** @var $user User */
            $user = PersonalAccessToken::findToken(substr($access_token,7))->tokenable()->first();
        }

        $user = $this->telegramService->authorize($data, $user);
        $user_token = $user->createToken('token')->plainTextToken;
        return redirect(
            sprintf(
                "%s/authorization/%s",
                getenv('FRONTEND_APP_URL'),
                $user_token
            )
        );
    }
}
