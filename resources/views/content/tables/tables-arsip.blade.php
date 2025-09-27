@extends('layouts/contentNavbarLayout')

@section('title', 'Arsip Data')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Data Arsip
    </h4>
    <!--/ Basic Bootstrap Table -->

    <!-- Bootstrap Table with Header - Dark -->
    <hr class="my-5">

    <!-- Bordered Table -->
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
                        {{-- @foreach ($users as $user) --}}
                        <tr>
                            <td>1</td>
                            <td>Tes.pdf</td>
                            <td>tteess</td>
                            <td>tteess</td>
                            <td>tteess</td>
                            <td>14-08-2025</td>
                            <td>
                                <button class="btn btn-info rounded-2 w-25">
                                    Edit
                                </button>
                                <button class="btn rounded-2 w-25 text-white" style="background: red">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
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
@endsection
