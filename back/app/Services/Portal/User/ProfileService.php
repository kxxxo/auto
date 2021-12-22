<?php

namespace App\Services\Portal\User;

use App\Models\Profile;
use App\Models\ProfileMail;
use App\Models\ProfileTelegram;
use App\Models\ProfileTelephone;
use App\Models\ProfileVk;
use App\Models\ProfileWhatsapp;
use App\Models\User;
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
        $profile_vk = ProfileVk::whereExternalId($external_id)->first();
        if (!$profile_vk) {
            $profile_vk = new ProfileVk(
                [
                    'external_id' => $external_id,
                    'access_token' => $access_token,
                    'email' => $email
                ]
            );
            if (!$profile_vk->save()) {
                throw new Exception("Profile vk save error");
            }
            if (!$user) {
                $user = $this->userService->create();
                $profile = $this->create($user);
            } else {
                $profile = Profile::whereUserId($user->id)->first();
            }
            $profile->profile_vk_id = $profile_vk->id;
            $profile->save();
        } else {
            $profile_vk->access_token = $access_token;
            if (!$profile_vk->save()) {
                throw new Exception("Profile vk save error");
            }
        }
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
            if (!$user) {
                $user = $this->userService->create();
                $profile = $this->create($user);
            } else {
                $profile = Profile::whereUserId($user->id)->first();
            }

            $profile->profile_telegram_id = $profile_telegram->id;
            $profile->save();
        } else {
            $profile_telegram->first_name = $first_name;
            $profile_telegram->last_name = $last_name;
            $profile_telegram->username = $username;
            $profile_telegram->photo_url = $photo_url;
            if (!$profile_telegram->save()) {
                throw new Exception("Profile telegram save error");
            }
        }
        return $profile_telegram;
    }

    /**
     * @throws Exception
     */
    public function connectWithTelephone($external_id, User $user = null): ProfileTelephone
    {
        $profile_telephone = ProfileTelephone::whereExternalId($external_id)->first();
        if (!$profile_telephone) {
            $profile_telephone = new ProfileTelephone([
                'external_id' => $external_id,
            ]);
            if (!$profile_telephone->save()) {
                throw new Exception("Profile telephone save error");
            }
            if (!$user) {
                $user = $this->userService->create();
                $profile = $this->create($user);
            } else {
                $profile = Profile::whereUserId($user->id)->first();
            }

            $profile->profile_telephone_id = $profile_telephone->id;
            $profile->save();
        }
        return $profile_telephone;
    }

    /**
     * @throws Exception
     */
    public function connectWithWhatsapp($external_id, User $user = null): ProfileWhatsapp
    {
        $profile_whatsapp = ProfileWhatsapp::whereExternalId($external_id)->first();
        if (!$profile_whatsapp) {
            $profile_whatsapp = new ProfileWhatsapp([
                'external_id' => $external_id,
            ]);
            if (!$profile_whatsapp->save()) {
                throw new Exception("Profile whatsapp save error");
            }
            if (!$user) {
                $user = $this->userService->create();
                $profile = $this->create($user);
            } else {
                $profile = Profile::whereUserId($user->id)->first();
            }

            $profile->profile_whatsapp_id = $profile_whatsapp->id;
            $profile->save();
        }
        return $profile_whatsapp;
    }

    /**
     * @throws Exception
     */
    public function connectWithEmail($external_id, User $user = null): ProfileMail
    {
        $profile_email = ProfileMail::whereExternalId($external_id)->first();
        if (!$profile_email) {
            $profile_email = new ProfileMail([
                'external_id' => $external_id,
            ]);
            if (!$profile_email->save()) {
                throw new Exception("Profile email save error");
            }
            if (!$user) {
                $user = $this->userService->create();
                $profile = $this->create($user);
            } else {
                $profile = Profile::whereUserId($user->id)->first();
            }

            $profile->profile_email_id = $profile_email->id;
            $profile->save();
        }
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
