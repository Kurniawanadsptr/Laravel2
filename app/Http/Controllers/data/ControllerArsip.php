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
  public function index(Request $request)
  {
    $userLogin = Auth::user();
    $query = ArsipModels::with('user');

    if ($userLogin->role !== 'General Admin') {
      $query->where('users_id', $userLogin->id_user);
    }

    if ($request->ajax()) {
      $search = $request->search;
      $query->where(function ($q) use ($search) {
        $q->where('name_file', 'like', "%{$search}%")
          ->orWhere('file', 'like', "%{$search}%")
          ->orWhere('no_surat', 'like', "%{$search}%")
          ->orWhere('perihal', 'like', "%{$search}%");
      });

      $rowArsip = $query->get();

      $html = '';
      foreach ($rowArsip as $index => $arsip) {
        $html .= '<tr>';
        $html .= '<td>' . ($index + 1) . '</td>';
        $html .= '<td><a href="' . url("arsip/file/$arsip->date_upload/$arsip->file") . '" target="_blank">' . $arsip->file . '</a></td>';
        $html .= '<td>' . $arsip->name_file . '</td>';
        $html .= '<td>' . $arsip->no_surat . '</td>';
        $html .= '<td>' . $arsip->perihal . '</td>';
        $html .= '<td><span style="color:' . ($arsip->file_eksis == 'Ada' ? 'green' : 'red') . '">' . $arsip->file_eksis . '</span></td>';
        $html .= '<td>' . $arsip->size_file . '</td>';
        $html .= '<td>' . $arsip->date_upload . '</td>';
        $html .= '<td>' . $arsip->user->role . '</td>';

        if ($userLogin->role !== 'General Admin') {
          $html .= '<td>
                    <button class="btn btn-info rounded-2 w-25" id="editArsip" data-id="' . $arsip->id_arsip . '">Edit</button>
                    <form action="' . route('hapus-arsip', $arsip->id_arsip) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger rounded-2 text-white">Delete</button>
                    </form>
                </td>';
        }

        $html .= '</tr>';
      }

      if (count($rowArsip) === 0) {
        $html = '<tr><td colspan="10" class="text-center">Tidak Ada Data</td></tr>';
      }

      return $html;
    }

    $rowArsip = $query->get();
    return view('content.tables.tables-arsip', compact('rowArsip'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama_dokumen' => 'required|string|max:255',
    ]);

    $file = $request->file('file');
    $nama_dokumen = $request->input('nama_dokumen');
    $no_surat = $request->input('no_surat');
    $perihal = $request->input('perihal');
    $file_eksis = $request->input('file_eksis');
    $filename = $file->getClientOriginalName();
    $size = $file->getSize();
    $folder = 'public/uploads/arsip/' . now()->format('Y-m-d');
    $path = $file->storeAs($folder, $filename);
    $date = date('Y-m-d');
    ArsipModels::create([
      'file' => $filename,
      'name_file' => $nama_dokumen,
      'no_surat' => $no_surat,
      'perihal' => $perihal,
      'file_eksis' => $file_eksis,
      'size_file' => $this->bytes_to_size($size),
      'nama_dokumen' => $request->nama_dokumen,
      'date_upload' => $date,
      'users_id' => Auth::user()->id_user,
    ]);

    return redirect()->back()->with('success', 'Data arsip berhasil disimpan.');
  }

  public function edit($id_arsip)
  {
    $id_arsip = ArsipModels::findOrFail($id_arsip);
    return response()->json($id_arsip);
  }

  public function update(Request $request, $id_arsip)
  {
    $request->validate([
      'nama_dokumen_edit' => 'required|string',
      'no_surat_edit' => 'nullable|string',
      'perihal_edit' => 'nullable|string',
      'file_eksis_edit' => 'nullable|string',
      'file_edit' => 'nullable|file|mimes:pdf,docx,jpg,png|max:9999999999'
    ]);
    $arsip = ArsipModels::findOrFail($id_arsip);
    $arsip->name_file = $request->nama_dokumen_edit;
    $arsip->no_surat = $request->no_surat_edit;
    $arsip->perihal = $request->perihal_edit;
    $arsip->file_eksis = $request->file_eksis_edit;
    if ($request->hasFile('file_edit')) {
      $oldPath = storage_path("app/public/uploads/arsip/{$arsip->date_upload}/{$arsip->file}");
      if (file_exists($oldPath)) {
        unlink($oldPath);
      }
      $file = $request->file('file_edit');
      $filename = time() . '_' . $file->getClientOriginalName();
      $tanggal = now()->format('Y-m-d');

      $file->storeAs("public/uploads/arsip/{$tanggal}", $filename);
      $arsip->file = $filename;
      $arsip->date_upload = $tanggal;
      $size = $file->getSize();
      $arsip->size_file = $this->bytes_to_size($size);
    }
    $arsip->save();

    return response()->json(['success' => true]);
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
