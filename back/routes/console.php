<?php

use App\Services\Notification\TelegramService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('cpu', function (TelegramService $telegramService){
    var_dump(sys_getloadavg());
    echo round(disk_free_space('/')/1024/1024/1024,2) . " из " . round(disk_total_space('/')/1024/1024/1024,2);
//    $telegramService->sendMessage("Ку-ку");
//    DB::table('recent_users')->delete();
});
