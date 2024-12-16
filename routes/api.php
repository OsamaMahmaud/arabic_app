<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Authentication\verifyOtp;
use App\Http\Controllers\User\Authentication\RegisterController;
use App\Http\Controllers\User\Authentication\AccessTokensController;
use App\Http\Controllers\User\Authentication\ResetPasswordController;
use App\Http\Controllers\User\Authentication\FoegetPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#----------------------------Start auth-user--------------------------------------------------------##
Route::post('/user_register', [RegisterController::class, 'register']);

Route::post('user_login', [AccessTokensController::class, 'login'])->name('login');

Route::post('user_logout/{token?}', [AccessTokensController::class, 'destroy'])->middleware('auth:sanctum');
#----------------------------Start auth-user---------------------------------------------------------##

#----------------------------Start Forget Password---------------------------------------------------##
route::post('forgetpassword',[FoegetPasswordController::class,'forgetPassword']);
#----------------------------End Forget Password-----------------------------------------------------##

#----------------------------Start verify Password---------------------------------------------------##
route::post('resetpassword',[ResetPasswordController::class,'resetPassword']);
#----------------------------End verify Password-----------------------------------------------------##

#----------------------------Start Reset Password----------------------------------------------------##
Route::post('/password/verify-otp', [verifyOtp::class, 'verifyOtp']);
#----------------------------End Reset Password------------------------------------------------------##


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
