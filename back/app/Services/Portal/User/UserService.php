<?php

namespace App\Services\Portal\User;

use App\Models\User;

/**
 * Class UserService
 * @package App\Services\Portal\User
 */
class UserService
{
    /**
     * Создание нового пользователя
     *
     * @return User
     */
    public function create(): User
    {
        return (new User())->create(
            [
                'password' => bcrypt(date('U')),
            ]
        );
    }
}
