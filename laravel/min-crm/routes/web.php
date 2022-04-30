<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['isLoggedInUser']],function (){
    Route::view('/','index')->name('index');
    Route::view('reg-step1', 'register')->name('reg-step1');
    Route::post('register', [LoginController::class, 'register'])->name('reg-step2');
    Route::post('signin',[LoginController::class,'login'])->name('login');
});
Route::group(['middleware' => ['authCheck']], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [LoginController::class, 'getDashboardData'])->name('dashboard');
    Route::post('update-profile', [UserController::class, 'updateUserProfile'])->name('update-profile');
    Route::get('users/list',[UserController::class,'getAllUsers'])->name('users-list');
    Route::view('import-view','import_user')->name('import-view');
    Route::post('/import',[UserController::class,'importUser'])->name('import-user');
    Route::view('manual-add','manual_add_user')->name('manually-add-view');
    Route::post('add-user',[UserController::class,'addUsers'])->name('add-users');
});
