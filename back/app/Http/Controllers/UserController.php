<?php

namespace App\Http\Controllers;

use App\Services\Authorization\TelegramService;
use App\Services\Authorization\VkService;

class UserController extends Controller
{
    /** @var VkService */
    protected $vkService;

    /** @var TelegramService */
    protected $telegramService;


    public function __construct(VkService $vkService, TelegramService $telegramService)
    {
        $this->vkService = $vkService;
        $this->telegramService = $telegramService;
    }
}
