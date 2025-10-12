<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Analytics extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $labels = ['Januari', 'Februari', 'Maret', 'April'];
    $data = [100, 200, 150, 300];
    $role = $user->role;
    return view('content.dashboard.dashboards-index', compact('role', 'labels', 'data'));
  }
}
