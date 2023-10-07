<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\PhoneBookController;
use Illuminate\Support\Facades\Route;


Route::post('sign-up',[RegisterController::class,'signUp']);
Route::post('sign-in',[LoginController::class,'signIn']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('phone-book')->group(function () {
        Route::post('create',[PhoneBookController::class,'create']);
        Route::put('update',[PhoneBookController::class,'update']);
        Route::get('get',[PhoneBookController::class,'get']);
        Route::delete('delete',[PhoneBookController::class,'delete']);
    });
});



