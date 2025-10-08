<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ControllerAccount extends Controller
{
  public function index()
  {
    // Pastikan user sudah login dan role-nya General Admin
    if (Auth::check() && Auth::user()->role === 'General Admin') {
      $user = User::get();
      return view('content.pages.account', compact('user'));
    }

    abort(403, 'Unauthorized');
  }
  public function store(Request $request)
  {
    User::create([
      'username' => $request->input('username'),
      'password' => Hash::make($request->input('password')),
      'role' => $request->input('role'),
    ]);
    return redirect()->back()->with('success', 'Data arsip berhasil disimpan.');
  }
  public function delete($id_user)
  {
    $accountDelete = User::findOrFail($id_user);

    $accountDelete->delete();

    return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
  }
}
