<?php

namespace App\Http\Controllers;

use App\Services\Authorization\EmailService;
use Exception;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class EmailConfirmController extends Controller
{

    /** @var $emailService EmailService */
    private $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function index(Request $request)
    {
        return view('email-confirm')->with([
            'access_token' => $request->get('access_token')
        ]);
    }

    /**
     * @throws Exception
     * Слишком много запросов. Обновите страницу и попробуйте позже
     */
    public function sendCode(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
        ]);
        $this->emailService->sendCode($data['email']);
        return null;
    }

    /**
     * @throws Exception
     */
    public function auth(Request $request): ?string
    {
        $data = $request->validate([
            'email' => 'required|string',
            'code' => 'required|string',
            'access_token' => 'string'
        ]);
        $code = $data['code'];
        $email = $data['email'];
        $access_token = $data['access_token'];
        $user = null;
        if($access_token) {
            /** @var PersonalAccessToken $model */
            $user = PersonalAccessToken::findToken(substr($access_token,7))->tokenable()->first();
        }

        $user = $this->emailService->authorize($email, $code, $user);
        if ($user) {
            return $user->createToken('token')->plainTextToken;
        } else {
            return null;
        }
    }
}
