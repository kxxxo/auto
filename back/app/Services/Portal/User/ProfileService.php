<?php

namespace App\Services\Portal\User;

use App\Models\Profile;
use App\Models\ProfileMail;
use App\Models\ProfileTelegram;
use App\Models\ProfileTelephone;
use App\Models\ProfileVk;
use App\Models\ProfileWhatsapp;
use App\Models\User;
use App\Services\Notification\TelegramService;
use Exception;

/**
 * Class ProfileService
 * @package App\Services\Portal\User
 */
class ProfileService
{

    /**
     * UserService
     *
     * @var UserService $userService
     */
    private $userService;

    /**
     * ProfileService constructor.
     *
     * @param UserService $userService DI
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Создание нового профиля для пользователя
     *
     * @param User $user Пользователь
     *
     * @return Profile
     * @throws Exception
     */
    private function create(User $user): Profile
    {
        $profile = (
            new Profile(
                [
                    'user_id' => $user->id,
                    'password' => rand(10000000, 99999999)
                ]
            )
        );
        if (!$profile->save()) {
            throw new Exception("Profile save error");
        }
        return $profile;
    }

    /**
     * Авторизация при помощи VK
     *
     * @param string $external_id VK ID
     * @param string $access_token Access Token
     * @param string $email Email - can be empty
     * @param User|null $user User - if we ween to connect with existed
     *
     * @return ProfileVk
     * @throws Exception
     */
    public function connectWithVk(
        string $external_id,
        string $access_token,
        string $email,
        User $user = null
    ): ProfileVk {
        /**
         * Поиск или создание пользователя
         */
        if ($user) {
            $profile = Profile::whereUserId($user->id)->first();
        } else {
            $user = $this->userService->create();
            $profile = $this->create($user);

        }

        /**
         * Поиск или создание профиля Whatsapp
         */
        $profile_vk = ProfileVk::whereExternalId($external_id)->first();
        if (!$profile_vk) {
            $profile_vk = new ProfileVk(
                [
                    'external_id' => $external_id,
                    'email' => $email,
                    'access_token' => $access_token
                ]
            );
            if (!$profile_vk->save()) {
                throw new Exception("Profile vk save error");
            }
        }


        /**
         * Отвязываем от прошлого владельца
         */
        Profile::query()
            ->where('profile_vk_id',$profile_vk->id)
            ->update(['profile_vk_id' => null]);

        /**
         * Привязка профиля vk, обновление токена
         */
        $profile_vk->access_token = $access_token;
        $profile_vk->save();
        $profile->profile_vk_id = $profile_vk->id;
        $profile->save();
        return $profile_vk;
    }

    /**
     * @throws Exception
     */
    public function connectWithTelegram(
        $external_id,
        $first_name,
        $last_name,
        $username,
        $photo_url,
        User $user = null
    ): ProfileTelegram {
        /**
         * Поиск или создание пользователя
         */
        if ($user) {
            $profile = Profile::whereUserId($user->id)->first();
        } else {
            $user = $this->userService->create();
            $profile = $this->create($user);
        }

        /**
         * Поиск или создание профиля Whatsapp
         */
        $profile_telegram = ProfileTelegram::whereExternalId($external_id)->first();
        if (!$profile_telegram) {
            $profile_telegram = new ProfileTelegram([
                'external_id' => $external_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'photo_url' => $photo_url
            ]);
            if (!$profile_telegram->save()) {
                throw new Exception("Profile telegram save error");
            }
        }

        /**
         * Отвязываем от прошлого владельца
         */
        Profile::query()
            ->where('profile_telegram_id',$profile_telegram->id)
            ->update(['profile_telegram_id' => null]);

        /**
         * Привязка профиля telegram, обновление данных
         */
        $profile_telegram->first_name = $first_name;
        $profile_telegram->last_name = $last_name;
        $profile_telegram->username = $username;
        $profile_telegram->photo_url = $photo_url;
        $profile->profile_telegram_id = $profile_telegram->id;
        $profile->save();

        return $profile_telegram;
    }

    /**
     * @throws Exception
     */
    public function connectWithTelephone($external_id, User $user = null): ProfileTelephone
    {
        /**
         * Поиск или создание пользователя
         */
        if ($user) {
            $profile = Profile::whereUserId($user->id)->first();
        } else {
            $user = $this->userService->create();
            $profile = $this->create($user);
        }

        /**
         * Поиск или создание Телефонного профиля
         */
        $profile_telephone = ProfileTelephone::whereExternalId($external_id)->first();
        if (!$profile_telephone) {
            $profile_telephone = new ProfileTelephone([
                'external_id' => $external_id,
            ]);
            if (!$profile_telephone->save()) {
                throw new Exception("Profile telephone save error");
            }
        }

        /**
         * Отвязываем от прошлого владельца
         */
        Profile::query()
            ->where('profile_telephone_id',$profile_telephone->id)
            ->update(['profile_telephone_id' => null]);

        /**
         * Привязка к новому
         */
        $profile->profile_telephone_id = $profile_telephone->id;
        $profile->save();
        return $profile_telephone;
    }

    /**
     * @throws Exception
     */
    public function connectWithWhatsapp($external_id, User $user = null): ProfileWhatsapp
    {
        /**
         * Поиск или создание пользователя
         */
        if($user) {
            $profile = Profile::whereUserId($user->id)->first();
        } else {
            $user = $this->userService->create();
            $profile = $this->create($user);
        }

        /**
         * Поиск или создание профиля Whatsapp
         */
        $profile_whatsapp = ProfileWhatsapp::whereExternalId($external_id)->first();
        if (!$profile_whatsapp) {
            $profile_whatsapp = new ProfileWhatsapp([
                'external_id' => $external_id,
            ]);
            if (!$profile_whatsapp->save()) {
                throw new Exception("Profile whatsapp save error");
            }
        }

        /**
         * Отвязываем от прошлого владельца
         */
        Profile::query()
            ->where('profile_whatsapp_id',$profile_whatsapp->id)
            ->update(['profile_whatsapp_id' => null]);


        /**
         * Привязываем к новому
         */
        $profile->profile_whatsapp_id = $profile_whatsapp->id;
        $profile->save();
        if (!$profile->save()) {
            (new TelegramService())->sendMessage("Profile whatsapp save error");
        }
        return $profile_whatsapp;
    }

    /**
     * @throws Exception
     */
    public function connectWithEmail($external_id, User $user = null): ProfileMail
    {
        /**
         * Поиск или создание пользователя
         */
        if ($user) {
            $profile = Profile::whereUserId($user->id)->first();
        } else {
            $user = $this->userService->create();
            $profile = $this->create($user);
        }

        /**
         * Поиск или создание профиля Email
         */
        $profile_email = ProfileMail::whereExternalId($external_id)->first();
        if (!$profile_email) {
            $profile_email = new ProfileMail([
                'external_id' => $external_id,
            ]);
            if (!$profile_email->save()) {
                throw new Exception("Profile email save error");
            }
        }

        /**
         * Отвязываем от прошлого владельца
         */
        Profile::query()
            ->where('profile_email_id',$profile_email->id)
            ->update(['profile_email_id' => null]);

        /**
         * Привязка к новому профилю Email
         */
        $profile->profile_email_id = $profile_email->id;
        $profile->save();
        return $profile_email;
    }

    /**
     * @param $count
     * @throws Exception
     */
    public function generateProfiles($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $user = $this->userService->create();
            $profile = $this->create($user);
        }
    }
}
