<?php

use App\Http\Controllers\UserController;
use App\Models\Profile;
use App\Services\Authorization\VkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/profile', function (Request $request) {
        $profile = Profile::whereUserId(
            auth()->user()->getAuthIdentifier()
        )->first();
        return [
            'vk' => $profile->profile_vk_id ? [
                'id' => $profile->profile_vk_id,
                'is_enable' => $profile->profileVk->is_enable
            ] : null,
            'mail' => $profile->profile_email_id ? [
                'id' => $profile->profile_email_id,
                'is_enable' => $profile->profileMail->is_enable
            ] : null,
            'telegram' => $profile->profile_telegram_id ? [
                'id' => $profile->profile_telegram_id,
                'is_enable' => $profile->profileTelegram->is_enable
            ] : null,
            'telephone' => $profile->profile_telephone_id ? [
                'id' => $profile->profile_telephone_id,
                'is_enable' => $profile->profileTelephone->is_enable
            ] : null,
            'whatsapp' => $profile->profile_whatsapp_id ? [
                'id' => $profile->profile_whatsapp_id,
                'is_enable' => $profile->profileWhatsapp->is_enable
            ] : null
        ];
    });

    Route::prefix('/toggle')->group(function () {
        Route::post('/vk', function (Request $request) {
            $profile = Profile::whereUserId(
                auth()->user()->getAuthIdentifier()
            )->first();
            if ($profile->profile_vk_id) {
                $profile->profileVk->is_enable = $request->post('value');
                $profile->profileVk->save();
            }
        });
        Route::post('/mail', function (Request $request) {
            $profile = Profile::whereUserId(
                auth()->user()->getAuthIdentifier()
            )->first();
            if ($profile->profile_email_id) {
                $profile->profileMail->is_enable = $request->post('value');
                $profile->profileMail->save();
            }
        });
        Route::post('/telegram', function (Request $request) {
            $profile = Profile::whereUserId(
                auth()->user()->getAuthIdentifier()
            )->first();
            if ($profile->profile_telegram_id) {
                $profile->profileTelegram->is_enable = $request->post('value');
                $profile->profileTelegram->save();
            }
        });
        Route::post('/telephone', function (Request $request) {
            $profile = Profile::whereUserId(
                auth()->user()->getAuthIdentifier()
            )->first();
            if ($profile->profile_telephone_id) {
                $profile->profileTelephone->is_enable = $request->post('value');
                $profile->profileTelephone->save();
            }
        });
        Route::post('/whatsapp', function (Request $request) {
            $profile = Profile::whereUserId(
                auth()->user()->getAuthIdentifier()
            )->first();
            if ($profile->profile_whatsapp_id) {
                $profile->profileWhatsapp->is_enable = $request->post('value');
                $profile->profileWhatsapp->save();
            }
        });
    });
});

Route::get('/get-authorization-url', function (VkService $vkService) {
    return [
        'vk_url' => $vkService->generateUrlForAuth(),
        'email_url' => getenv('APP_URL') . '/email-confirm',
        'telephone_url' => getenv('APP_URL') . '/telephone-confirm',
        'telegram_url' => getenv('APP_URL') . '/telegram-confirm'
    ];
});

Route::get('/get-profile', function (Request $request) {
    return Profile::where('profiles.id', '=', $request->get('id'))
        ->select([
            'profiles.id as id',
            'profile_vks.external_id as vk',
            'profile_mails.external_id as mail',
            'profile_telegrams.external_id as telegram',
            'profile_whatsapps.external_id as whatsapp',
            'profile_telephones.external_id as telephone',
        ])
        ->leftJoin('profile_vks', function ($join) {
            $join->on('profile_vks.id', '=', 'profiles.profile_vk_id');
            $join->on('profile_vks.is_enable', DB::raw('true'));
        })
        ->leftJoin('profile_mails', function ($join) {
            $join->on('profile_mails.id', '=', 'profiles.profile_email_id');
            $join->on('profile_mails.is_enable', DB::raw('true'));
        })
        ->leftJoin('profile_telegrams', function ($join) {
            $join->on('profile_telegrams.id', '=', 'profiles.profile_telegram_id');
            $join->on('profile_telegrams.is_enable', DB::raw('true'));
        })
        ->leftJoin('profile_whatsapps', function ($join) {
            $join->on('profile_whatsapps.id', '=', 'profiles.profile_whatsapp_id');
            $join->on('profile_whatsapps.is_enable', DB::raw('true'));
        })
        ->leftJoin('profile_telephones', function ($join) {
            $join->on('profile_telephones.id', '=', 'profiles.profile_telephone_id');
            $join->on('profile_telephones.is_enable', DB::raw('true'));
        })
        ->first();
});
