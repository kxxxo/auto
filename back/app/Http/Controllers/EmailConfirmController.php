<?php

namespace App\Http\Controllers;

use App\Services\Authorization\EmailService;
use Exception;
use Illuminate\Http\Request;

class EmailConfirmController extends Controller
{

    /** @var $emailService EmailService */
    private $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }
    public function index()
    {
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
        ]);
        $code = $data['code'];
        $email = $data['email'];
        $user = $this->emailService->authorize($email, $code);
        if ($user) {
            return $user->createToken('token')->plainTextToken;
        } else {
            return null;
        }
    }
}
