<?php

namespace App\Http\Controllers;

use App\Services\Authorization\TelegramService;
use App\Services\Authorization\TelephoneService;
use App\Services\Authorization\VkService;
use App\Services\Authorization\EmailService;
use Exception;
use Illuminate\Http\Request;

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
        $access_token = $request->validate([
            'code' => 'required|string',
        ])['code'];
        $user = $this->vkService->authorize($access_token);
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'photo_url' => 'required|string',
            'auth_date' => 'required|string',
            'hash' => 'required|string',
            'profile_id' => 'required|integer'
        ]);
        $profile_id = $data['profile_id'];
        unset($data['profile_id']);
        var_dump($data);
        $user = $this->telegramService->authorize($data);
        $user_token = $user->createToken('token')->plainTextToken;
        echo $user_token;
        die();
        return redirect(
            sprintf(
                "%s/authorization/%s",
                getenv('FRONTEND_APP_URL'),
                $user_token
            )
        );
    }
}
