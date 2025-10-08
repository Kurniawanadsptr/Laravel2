@extends('layouts/contentNavbarLayout')

@section('title', 'Arsip Data')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Data Arsip
    </h4>
    <hr class="my-5">

    <!-- Bordered Table -->
    @if(Auth::user()->role === 'General Admin')
    <button class="btn rounded-2 mb-3 w-10 text-white colorBackground" data-bs-toggle="modal"
        data-bs-target="#modalTambahData">
        Tambah Data
    </button>
    @endif

    <div class="card">
        <h5 class="card-header">Data Account</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="users-table" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>Users</th>
                            @if(Auth::user()->role === 'General Admin')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{--  --}}
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->password }}</td>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->telephone }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $data->role }}</td>
                                @if(Auth::user()->role === 'General Admin')
                                <td>
                                    <button class="btn btn-info rounded-2 w-25" id="editdata" data-id="{{ $data->id_user  }}">Edit</button>
                                    <form action="{{ route('hapus-account', $data->id_user ) }}" method="POST"
                                        style="display: inline-block;"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-2 text-white">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>Users</th>
                            @if(Auth::user()->role !== 'General Admin')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('account-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="Direktorat 81">Direktorat 81</option>
                                <option value="Direktorat 82">Direktorat 82</option>
                                <option value="Direktorat 83">Direktorat 83</option>
                            </select>
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

@endsection

@section('page-script')
<script src="{{ asset('assets/js/arsip.js') }}"></script>
@endsection
