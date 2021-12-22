<?php

namespace App\Services\Authorization;

use App\Models\TelephoneConfirm;
use App\Models\User;
use App\Services\Portal\User\ProfileService;
use DateInterval;
use DateTime;
use Exception;

/**
 * Class TelephoneService
 * @package App\Http\Services
 */
class TelephoneService
{
    /**  @var ProfileService */
    private $profileService;

    /** @var \App\Services\Notification\TelephoneService */
    private $telephoneService;

    /**
     * TelephoneService constructor.
     * @param ProfileService $profileService
     * @param \App\Services\Notification\TelephoneService $telephoneService
     */
    public function __construct(
        ProfileService $profileService,
        \App\Services\Notification\TelephoneService $telephoneService
    ) {
        $this->profileService = $profileService;
        $this->telephoneService = $telephoneService;
    }

    /**
     * @throws Exception
     */
    public function sendCode($telephone)
    {
        $telephone_confirm = TelephoneConfirm::whereTelephone($telephone)->first();
        /** Сначала удаляем старую запись с ограничением в 1 минуту */
        if ($telephone_confirm) {
            /** @var $telephone_confirm TelephoneConfirm */
            $date_time = DateTime::createFromFormat('Y-m-d H:i:s', $telephone_confirm->created_at);
            if (new DateTime() > $date_time->add(new DateInterval('PT1M'))) {
                $telephone_confirm->delete();
            } else {
                throw new Exception("Слишком много запросов (1 смс/мин.)<br/>" .
                                            "Обновите страницу и попробуйте позже");
            }
        }

        $telephone_confirm = TelephoneConfirm::create([
            'telephone' => $telephone,
            'code' => rand(100000, 999999)
        ]);
        $this->telephoneService->sendMessage($telephone, "Ваш код активации: $telephone_confirm->code");
    }

    /**
     * @throws Exception
     */
    public function resendCode($telephone)
    {
        $telephone_confirm = TelephoneConfirm::whereTelephone($telephone)->first();
        if (!$telephone_confirm) {
            $this->sendCode($telephone);
            return;
        }
        if ($telephone_confirm->attempts >= 3) {
            throw new Exception("Код устарел, запросите новый");
        }
        $telephone_confirm->attempts++;
        $telephone_confirm->save();
        $this->telephoneService->sendMessage($telephone, "Ваш код активации: $telephone_confirm->code");
    }

    /**
     * @throws Exception
     */
    public function check($telephone, $code): bool
    {
        $telephone_confirm = TelephoneConfirm::whereTelephone($telephone)->first();
        if (!$telephone_confirm) {
            throw new Exception("СМС Код не найден");
        }
        if ($telephone_confirm->code == $code) {
            return true;
        } else {
            $telephone_confirm->attempts++;
            $telephone_confirm->save();
            return false;
        }
    }
    /**
     * @throws Exception
     */
    public function authorize($telephone, $code, $user = null): ?User
    {
        if ($this->check($telephone, $code)) {
            $profile_whatsapp = $this->profileService->connectWithWhatsapp($telephone,$user);
            $profile_telephone = $this->profileService->connectWithTelephone(
                $telephone,
                $profile_whatsapp->profile->user
            );
            return $profile_telephone->profile->user;
        } else {
            return null;
        }
    }
}
