<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailConfirmController;
use App\Http\Controllers\PasswordConfirmController;
use App\Http\Controllers\TelephoneConfirmController;
use App\Models\Profile;
use App\Services\Portal\User\ProfileService;
use App\Services\Portal\User\QRService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(getenv('FRONTEND_APP_URL'));
});

Route::prefix('/auth')->group(function () {
    Route::get('/vk', [AuthController::class, 'vk'])->name('web.auth.vk');
    Route::get('/tg', [AuthController::class, 'tg'])->name('web.auth.tg');
});

Route::prefix('/telephone-confirm')->group(function () {
    Route::get('/', [TelephoneConfirmController::class,'index'])->name('web.telephone-confirm');
    Route::get('/send-code', [TelephoneConfirmController::class,'sendCode']);
    Route::get('/resend-code', [TelephoneConfirmController::class,'resendCode']);
    Route::get('/auth', [TelephoneConfirmController::class,'auth']);
});
Route::prefix('/email-confirm')->group(function () {
    Route::get('/', [EmailConfirmController::class,'index'])->name('web.email-confirm');
    Route::get('/send-code', [EmailConfirmController::class,'sendCode']);
    Route::get('/resend-code', [EmailConfirmController::class,'resendCode']);
    Route::get('/auth', [EmailConfirmController::class,'auth']);
});
Route::prefix('/password-confirm')->group(function () {
    Route::get('/', function (Request $request) {
        return view('password-confirm', [
        ]);
    })->name('web.password-confirm');
    Route::get('/auth', [PasswordConfirmController::class,'auth']);
});


Route::get('/telegram-confirm', function (Request $request) {
    return view('telegram-confirm')->with([
        'access_token' => $request->get('access_token')
    ]);
});

Route::get('/qr', function (QRService $QRService) {
    $profiles = Profile::orderBy('id')->get();
    return $QRService->generateSticky($profiles);
});
Route::get('/generate', function (ProfileService $profileService) {
    $profileService->generateProfiles(50);
});
