<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
  public function index()
  {
    return view('content.authentications.login');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'username' => ['required', 'string'],
      'password' => ['required', 'string'],
    ]);
    if (Auth::attempt([
      'username' => $credentials['username'],
      'password' => $credentials['password'],
    ])) {
      $request->session()->regenerate();
      $user = Auth::user();
      if ($user->role !== 'General Admin') {
        $inputRole = $request->input('role');
        if ($user->role !== $inputRole) {
          Auth::logout();
          return back()->withErrors([
            'error' => 'Login gagal. Periksa kembali username dan password atau role.',
          ])->onlyInput('error');
        }
      }

      return redirect()->intended('/');
    }

    return back()->withErrors([
      'error' => 'Login gagal. Periksa kembali username dan password atau role.',
    ])->onlyInput('error');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/auth-login');
  }
}
