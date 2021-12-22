<?php

namespace App\Services\Authorization;

use App\Models\EmailConfirm;
use App\Models\User;
use App\Services\Portal\User\ProfileService;
use DateInterval;
use DateTime;
use Exception;

/**
 * Class EmailService
 * @package App\Http\Services
 */
class EmailService
{
    /**  @var ProfileService */
    private $profileService;

    /** @var \App\Services\Notification\EmailService */
    private $emailService;

    /**
     * EmailService constructor.
     * @param ProfileService $profileService
     * @param \App\Services\Notification\EmailService $emailService
     */
    public function __construct(ProfileService $profileService, \App\Services\Notification\EmailService $emailService)
    {
        $this->profileService = $profileService;
        $this->emailService = $emailService;
    }


    /**
     * @throws Exception
     */
    public function sendCode($email)
    {
        $email_confirm = EmailConfirm::whereEmail($email)->first();
        /** Сначала удаляем старую запись с ограничением в 1 минуту */
        if ($email_confirm) {
            /** @var $email_confirm EmailConfirm */
            $date_time = DateTime::createFromFormat('Y-m-d H:i:s', $email_confirm->created_at);
            if (new DateTime() > $date_time->add(new DateInterval('PT1M'))) {
                $email_confirm->delete();
            } else {
                throw new Exception("Слишком много запросов. Обновите страницу и попробуйте позже");
            }
        }

        $email_confirm = EmailConfirm::create([
            'email' => $email,
            'code' => rand(100000, 999999)
        ]);
        $this->emailService->sendMessage($email, $email_confirm->code);
    }

    /**
     * @throws Exception
     */
    public function resendCode($email)
    {
        $email_confirm = EmailConfirm::whereEmail($email)->first();
        if (!$email_confirm) {
            $this->sendCode($email);
            return;
        }
        if ($email_confirm->attempts >= 3) {
            throw new Exception("Код устарел, запросите новый");
        }
        $email_confirm->attempts++;
        $email_confirm->save();
        $this->emailService->sendMessage($email, $email_confirm->code);
    }

    /**
     * @throws Exception
     */
    public function check($email, $code): bool
    {
        $email_confirm = EmailConfirm::whereEmail($email)->first();
        if (!$email_confirm) {
            throw new Exception("Письмо не найдено");
        }
        if ($email_confirm->code == $code) {
            return true;
        } else {
            $email_confirm->attempts++;
            $email_confirm->save();
            return false;
        }
    }
    /**
     * @throws Exception
     */
    public function authorize($email, $code, $user = null): ?User
    {
        if ($this->check($email, $code)) {
            return $this->profileService->connectWithEmail($email, $user)->profile->user;
        } else {
            return null;
        }
    }
}
