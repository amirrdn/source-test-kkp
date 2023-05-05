<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FishingController;

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

Route::post('/registration', [LoginController::class, 'registration']);
Route::post('/verification-otp', [VerifyEmailController::class, 'verifyotp'])->name('verification.verifyotp');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth:api')->get('pending-member', [MemberController::class, 'userpending']);
Route::middleware('auth:api')->post('active-member', [MemberController::class, 'activemember']);
Route::middleware('auth:api')->post('boat/insert', [FishingController::class, 'store']);
Route::middleware('auth:api')->get('fishing-data', [FishingController::class, 'view']);
Route::middleware('auth:api')->post('update-fishing', [FishingController::class, 'update']);
