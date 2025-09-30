<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\Login;
use App\Http\Controllers\data\ControllerArsip;
use Illuminate\Support\Facades\Auth;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->middleware('auth')->name('Dashboard');
// pages account
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');

// authentication
Route::get('/Login', [Login::class, 'index'])->name('Login');
Route::post('/auth-login', [Login::class, 'login']);
Route::post('/logout', function () {
  Auth::logout();
  request()->session()->invalidate();
  request()->session()->regenerateToken();
  return redirect('/Login');
})->name('logout');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// tables
Route::get('/table/arsip', [ControllerArsip::class, 'index'])->name('tables-arsip');

//data
Route::post('/arsip/store', [ControllerArsip::class, 'store'])->name('arsip.store');
Route::get('/arsip/{tanggal}/{filename}', function ($tanggal, $filename){
  $path = public_path("storage/uploads/arsip/{$tanggal}/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});

Route::delete('/arsip/delete/{id_arsip}', [ControllerArsip::class, 'delete'])->name('hapus-arsip');
