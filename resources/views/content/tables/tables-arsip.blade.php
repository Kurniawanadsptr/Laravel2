@extends('layouts/contentNavbarLayout')

@section('title', 'Arsip Data')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Data Arsip
    </h4>
    <hr class="my-5">

    <!-- Bordered Table -->
    <button class="btn rounded-2 mb-3 w-10 text-white" style="background:#16b1ff" data-bs-toggle="modal"
        data-bs-target="#modalTambahData">
        Tambah Data
    </button>

    <div class="card">
        <h5 class="card-header">Data Arsip</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="users-table" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Nama Dokumen</th>
                            <th>File Eksis</th>
                            <th>Ukuran File</th>
                            <th>Tgl Upload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rowArsip as $arsip)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ url("arsip/$arsip->date_upload/$arsip->file") }}">
                                        {{ $arsip->file }}
                                    </a>
                                </td>
                                <td>{{ $arsip->name_file }}</td>
                                <td>
                                    <span
                                        style="background-color: {{ $arsip->file_eksis == 'Ada' ? 'green' : 'red' }}; width: 30px; color:white;">
                                        {{ $arsip->file_eksis }}
                                    </span>
                                </td>
                                <td>{{ $arsip->size_file }}</td>
                                <td>{{ $arsip->date_upload }}</td>
                                <td>
                                    <button class="btn btn-info rounded-2 w-25">Edit</button>
                                    <form action="{{ route('hapus-arsip', $arsip->id_arsip) }}" method="POST"
                                        style="display: inline-block;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-2 text-white">
                                            Delete
                                        </button>
                                    </form>


                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Nama Dokumen</th>
                            <th>File Eksis</th>
                            <th>Ukuran File</th>
                            <th>Tgl Upload</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Arsip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                            <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">File Eksis</label>
                            <select class="form-control" name="file_eksis" id="file_eksis">
                                <option value="Ada">Ada</option>
                                <option value="Tidak Ada">Tidak Ada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                            <small class="text-muted">Format: PDF, DOCX, JPG, PNG</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
