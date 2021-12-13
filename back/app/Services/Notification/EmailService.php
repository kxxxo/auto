<?php

namespace App\Services\Notification;

use App\Mail\EmailCodeConfirm;
use Mail;

/**
 * Class EmailService
 * @package App\Http\Services
 */
class EmailService
{
    /**
     * @param $email
     * @param $code
     * @return bool
     */
    public function sendMessage($email, $code): bool
    {
        Mail::to($email)->send(new EmailCodeConfirm($code));
        return true;
    }
}
