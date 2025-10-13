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
    if (Auth::check() && Auth::user()->role === 'General Admin') {
      $user = User::where('role', '!=', 'General Admin')->get();
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
  public function edit($id_user)
  {
    $getData = User::findOrFail($id_user);
    return response()->json($getData);
  }

  public function update(request $request, $id_user)
  {
    $request->validate([
      'username_edit' => 'required|string',
      'first_name' => 'nullable|string',
      'email' => 'nullable|string',
      'telephone' => 'nullable|int',
      'address' => 'nullable|string',
    ]);
    $Account = User::findOrFail($id_user);

    $Account->username = $request->username_edit;
    $Account->first_name = $request->first_name;
    $Account->email = $request->email;
    $Account->telephone = $request->telephone;
    $Account->address = $request->address;

    if ($request->input('password_edit')) {
      $Account->password = Hash::make($request->input('password_edit'));
    }

    $Account->save();
    return response()->json(['success' => true]);
  }
  public function updatePersonal(request $request)
  {
    $request->validate([
      'id' => 'required|int',
      'username' => 'required|string',
      'first_name' => 'string',
      'last_name' => 'string',
      'email' => 'string',
      'telephone' => 'int',
      'address' => 'string',
    ]);
    $id_user = $request->id;
    $Account = User::findOrFail($id_user);
    $Account->username = $request->username;
    $Account->first_name = $request->firstName;
    $Account->last_name = $request->lastName;
    $Account->email = $request->email;
    $Account->telephone = $request->phoneNumber;
    $Account->address = $request->address;

    if ($request->input('password')) {
      $Account->password = Hash::make($request->password);
    }
    if ($request->hasFile('avatar')) {
      if ($Account->avatar === null) {
        $avatar = $request->file('avatar');
        $folder = 'public/assets/img/avatars/';
        $filename = $avatar->getClientOriginalName();
        $Account->avatar = $filename;
        $path = $avatar->storeAs($folder, $filename);
      } else {
        $oldPath = storage_path("app/public/assets/img/avatars/{$Account->getOriginal('avatar')}");
        if (file_exists($oldPath)) {
          unlink($oldPath);
        }
        $avatar = $request->file('avatar');
        $folder = 'public/assets/img/avatars/';
        $filename = $avatar->getClientOriginalName();
        $Account->avatar = $filename;
        $path = $avatar->storeAs($folder, $filename);
      }
    }
    $Account->save();
    return redirect()->back()->with(['success' => 'Data Berhasil Diubah']);
  }
  public function delete($id_user)
  {
    $accountDelete = User::findOrFail($id_user);

    $accountDelete->delete();

    return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
  }
}
