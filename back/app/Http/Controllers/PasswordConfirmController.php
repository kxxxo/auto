<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Services\Authorization\EmailService;
use Exception;
use Illuminate\Http\Request;

class PasswordConfirmController extends Controller
{
    /**
     * @throws Exception
     */
    public function auth(Request $request): ?string
    {
        $data = $request->validate([
            'password' => 'required|string',
            'id' => 'required|string',
        ]);
        $password = $data['password'];
        $id = $data['id'];
        $profile = Profile::whereId($id)
//            ->whereProfileEmailId(null)
//            ->whereProfileTelegramId(null)
//            ->whereProfileTelephoneId(null)
//            ->whereProfileVkId(null)
//            ->whereProfileWhatsappId(null)
            ->first();
        if ($profile && $profile->password === $password) {
            $user = $profile->user;
            return $user->createToken('token')->plainTextToken;
        } else {
            return null;
        }
    }
}
