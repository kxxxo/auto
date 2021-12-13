<?php

namespace App\Http\Controllers;

use App\Services\Authorization\TelephoneService;
use Exception;
use Illuminate\Http\Request;

class TelephoneConfirmController extends Controller
{

    /** @var $telephoneService TelephoneService */
    private $telephoneService;
    public function __construct(TelephoneService $telephoneService)
    {
        $this->telephoneService = $telephoneService;
    }
    public function index()
    {
    }

    /**
     * @throws Exception
     * Слишком много запросов. Обновите страницу и попробуйте позже
     * Ошибка отправки смс
     */
    public function sendCode(Request $request)
    {
        $data = $request->validate([
            'telephone' => 'required|string',
        ]);
        $this->telephoneService->sendCode($data['telephone']);
        return null;
    }

    /**
     * @throws Exception
     * Код устарел, запросите новый
     * Слишком много запросов. Обновите страницу и попробуйте позже
     */
    public function resendCode(Request $request)
    {
        $data = $request->validate([
            'telephone' => 'required|string',
        ]);
        $this->telephoneService->resendCode($data['telephone']);
        return null;
    }

    /**
     * @throws Exception
     * On success - redirect to front url
     * on null - new attempt
     * on exception - reload page
     */
    public function auth(Request $request): ?string
    {
        $data = $request->validate([
            'telephone' => 'required|string',
            'code' => 'required|string',
        ]);
        $code = $data['code'];
        $telephone = $data['telephone'];
        $user = $this->telephoneService->authorize($telephone, $code);
        if ($user) {
            return $user->createToken('token')->plainTextToken;
        } else {
            return null;
        }
    }
}
