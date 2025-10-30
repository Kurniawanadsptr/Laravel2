@extends('layouts/contentNavbarLayout')

@section('title', 'Arsip Data')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Data Arsip
    </h4>
    <hr class="my-5">

    @if (Auth::user()->role !== 'General Admin')
        <button class="btn rounded-2 mb-3 w-10 text-white colorBackground" data-bs-toggle="modal"
            data-bs-target="#modalTambahData">
            Tambah Data
        </button>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Arsip</h5>
            <input type="text" id="search" class="form-control w-20" placeholder="Search...">
        </div>

        <div class="card-body">
            <div class="table-wrapper">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th class="extra">No</th>
                            <th class="extra">File</th>
                            <th class="extra">Judul</th>
                            <th class="extra">Nama Dokumen</th>
                            <th class="extra">No. Surat</th>
                            <th class="extra-column">Jenis Dokumen</th>
                            <th class="extra-column">Kategori</th>
                            <th class="extra-column">File Eksis</th>
                            <th class="extra-column">Ukuran File</th>
                            <th class="extra-column">Tgl Upload</th>
                            <th class="extra-column">Users</th>
                            @if (Auth::user()->role !== 'General Admin')
                                <th class="extra-column">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="arsip-body">
                        @foreach ($rowArsip as $arsip)
                            <tr>
                                <td class="extra">{{ $loop->iteration }}</td>
                                <td class="extra"><a href="{{ url("arsip/file/$arsip->date_upload/$arsip->file") }}"
                                        target="_blank">{{ $arsip->file }}</a></td>
                                <td class="extra">{{ $arsip->judul }}</td>
                                <td class="extra">{{ $arsip->name_file }}</td>
                                <td class="extra">{{ $arsip->no_surat }}</td>
                                <td class="extra-column">{{ $arsip->jenis_dokumen }}</td>
                                <td class="extra-column">{{ $arsip->kategori }}</td>
                                <td class="extra-column">
                                    <span
                                        style="color: {{ $arsip->file_eksis == 'Ada' ? 'green' : 'red' }}">{{ $arsip->file_eksis }}</span>
                                </td>
                                <td class="extra-column">{{ $arsip->size_file }}</td>
                                <td class="extra-column">{{ $arsip->date_upload }}</td>
                                <td class="extra-column">{{ $arsip->user->role }}</td>
                                @if (Auth::user()->role !== 'General Admin')
                                    <td class="extra-column">
                                        <button class="btn btn-info rounded-2 w-25" id="editArsip"
                                            data-id="{{ $arsip->id_arsip }}">Edit</button>
                                        <form action="{{ route('hapus-arsip', $arsip->id_arsip) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger rounded-2 text-white">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="extra">No</th>
                            <th class="extra">File</th>
                            <th class="extra">Judul</th>
                            <th class="extra">Nama Dokumen</th>
                            <th class="extra">No. Surat</th>
                            <th class="extra-column">Jenis Dokumen</th>
                            <th class="extra-column">Kategori</th>
                            <th class="extra-column">File Eksis</th>
                            <th class="extra-column">Ukuran File</th>
                            <th class="extra-column">Tgl Upload</th>
                            <th class="extra-column">Users</th>
                            @if (Auth::user()->role !== 'General Admin')
                                <th class="extra-column">Actions</th>
                            @endif
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
                            <label for="nama_dokumen" class="form-label">No. Surat</label>
                            <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">File Eksis</label>
                            <select class="form-control" name="file_eksis" id="file_eksis">
                                <option value="Ada">Ada</option>
                                <option value="Tidak Ada">Tidak Ada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Jenis Dokumen</label>
                            <select class="form-control" name="jenis_dokumen" id="jenis_dokumen">
                                <option value="Lapintel">Lapintel</option>
                                <option value="Lapsus">Lapsus</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Kategori Laporan</label>
                            <select class="form-control" name="kategori_laporan" id="kategori_laporan">
                                <option value="Ideologi">Ideologi</option>
                                <option value="Politik">Politik</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Budaya">Budaya</option>
                                <option value="Pertahanan">Pertahanan</option>
                                <option value="Keamanan">Keamanan</option>
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

    <!-- Edit Form Modal -->
    <div class="modal fade" id="modalEditData" tabindex="-1" aria-labelledby="modalEditData" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditArsip" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Arsip</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3" hidden>
                            <label for="nama_dokumen" class="form-label">Id</label>
                            <input type="text" class="form-control" id="id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                            <input type="text" class="form-control" id="nama_dokumen_edit" name="nama_dokumen_edit">
                        </div>
                        <div class="mb-3">
                            <label for="no surat" class="form-label">No. Surat</label>
                            <input type="text" class="form-control" id="no_surat_edit" name="no_surat_edit">
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul_edit" name="judul_edit">
                        </div>
                        <div class="mb-3">
                            <label for="file eksis" class="form-label">File Eksis</label>
                            <select class="form-control" name="file_eksis_edit" id="file_eksis_edit">
                                <option value="Ada">Ada</option>
                                <option value="Tidak Ada">Tidak Ada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Jenis Dokumen</label>
                            <select class="form-control" name="jenis_dokumen_edit" id="jenis_dokumen_edit">
                                <option value="Lapintel">Lapintel</option>
                                <option value="Lapsus">Lapsus</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Kategori Laporan</label>
                            <select class="form-control" name="kategori_laporan_edit" id="kategori_laporan_edit">
                                <option value="Ideologi">Ideologi</option>
                                <option value="Politik">Politik</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Budaya">Budaya</option>
                                <option value="Pertahanan">Pertahanan</option>
                                <option value="Keamanan">Keamanan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File Lama</label>
                            <br>
                            <a id="spanFile" href="#" target="_blank">Lihat File</a>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file_edit" name="file_edit">
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

@section('page-script')
    <script src="{{ asset('assets/js/arsip.js') }}"></script>
@endsection
