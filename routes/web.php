<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\Login;
use App\Http\Controllers\data\ControllerArsip;
use App\Http\Controllers\data\ControllerAccount;

Route::get('/Login', [Login::class, 'index'])->name('Login');
Route::post('/auth-login', [Login::class, 'login']);
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

Route::post('/logout', function () {
  Auth::logout();
  request()->session()->invalidate();
  request()->session()->regenerateToken();
  return redirect('/Login');
})->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
  // Dashboard
  Route::get('/', [Analytics::class, 'index'])->name('Dashboard');

  // Account Settings
  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');

  // Arsip
  Route::get('/table/arsip', [ControllerArsip::class, 'index'])->name('tables-arsip');
  Route::get('/arsip/edit/{id_arsip}', [ControllerArsip::class, 'edit'])->name('arsip.edit.form');
  Route::post('/arsip/store', [ControllerArsip::class, 'store'])->name('arsip.store');
  Route::delete('/arsip/delete/{id_arsip}', [ControllerArsip::class, 'delete'])->name('hapus-arsip');
  Route::put('/arsip/edit/{id_arsip}', [ControllerArsip::class, 'update'])->name('arsip.edit');
  Route::get('/arsip/cetak-pdf', [ControllerArsip::class, 'cetakPdf'])->name('arsip.cetak-pdf');

  // File Review
  Route::get('/arsip/file/{tanggal}/{filename}', function ($tanggal, $filename) {
    $path = public_path("storage/uploads/arsip/{$tanggal}/{$filename}");

    if (!file_exists($path)) {
      abort(404);
    }

    return response()->file($path);
  })->name('arsip.file');

  Route::get('/pages/account', [ControllerAccount::class, 'index'])->middleware('auth');
  Route::get('/account/edit/{id_user}', [ControllerAccount::class, 'edit'])->middleware('auth');
  Route::put('/account/edit/{id_user}', [ControllerAccount::class, 'update'])->middleware('auth');
  Route::post('/account/store', [ControllerAccount::class, 'store'])->name('account-store');
  Route::post('/process/edit', [ControllerAccount::class, 'updatePersonal'])->middleware('auth');
  Route::delete('/arsip/account/delete/{id_user}', [ControllerAccount::class, 'delete'])->name('hapus-account');
});
