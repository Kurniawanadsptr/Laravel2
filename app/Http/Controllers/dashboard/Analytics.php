<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArsipModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Analytics extends Controller
{
  public function index()
  {
    $arsips = ArsipModels::with('user')->get();

    $roleCounts = [];

    foreach ($arsips as $arsip) {
      $role = $arsip->user->role ?? 'unknown';

      if (!isset($roleCounts[$role])) {
        $roleCounts[$role] = 0;
      }

      $roleCounts[$role]++;
    }

    $labels = array_keys($roleCounts);
    $data = array_values($roleCounts);

    return view('content.dashboard.dashboards-index', compact('roleCounts', 'labels', 'data'));
  }
}
