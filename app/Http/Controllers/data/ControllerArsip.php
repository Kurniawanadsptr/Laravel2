<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArsipModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ControllerArsip extends Controller
{
  private function bytes_to_size($bytes)
  {
    $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if ($bytes == 0) return '0 Byte';
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 2) . ' ' . $sizes[$i];
  }
  public function index()
  {
    $rowArsip = ArsipModels::all();
    return view('content.tables.tables-arsip', compact('rowArsip'));
  }
  public function store(Request $request)
  {
    $request->validate([
      'nama_dokumen' => 'required|string|max:255',
    ]);

    $file = $request->file('file');
    $nama_dokumen = $request->input('nama_dokumen');
    $file_eksis = $request->input('file_eksis');
    $filename = $file->getClientOriginalName();
    $size = $file->getSize();
    $folder = 'public/uploads/arsip/' . now()->format('Y-m-d');
    $path = $file->storeAs($folder, $filename);
    $date = date('Y-m-d');
    ArsipModels::create([
      'file' => $filename,
      'name_file' => $nama_dokumen,
      'file_eksis' => $file_eksis,
      'size_file' => $this->bytes_to_size($size),
      'nama_dokumen' => $request->nama_dokumen,
      'date_upload' => $date,
      'users' => Auth::user()->id_user,
    ]);

    return redirect()->back()->with('success', 'Data arsip berhasil disimpan.');
  }

  public function delete($id_arsip)
  {
    $arsip = ArsipModels::findOrFail($id_arsip);

    $filePath = 'public/uploads/arsip/' . $arsip->date_upload . '/' . $arsip->file;

    if (Storage::exists($filePath)) {
      Storage::delete($filePath);
    }

    $arsip->delete();

    return redirect()->route('tables-arsip')
      ->with(['success' => 'Data Berhasil Dihapus']);
  }
}
