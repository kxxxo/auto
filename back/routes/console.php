<?php

use App\Models\Monitor;
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
    $cpu = sys_getloadavg();
    $free_disk = round(disk_free_space('/')/1024/1024/1024,2);
    $max_disk = round(disk_total_space('/')/1024/1024/1024,2);
    echo Monitor::insert([
        'cpu' => (string)$cpu,
        'free_disk' => (string)$free_disk,
        'max_disk' => (string)$max_disk
    ]).PHP_EOL  ;
});
