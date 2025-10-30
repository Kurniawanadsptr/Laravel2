<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Halaman Arsip PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    @if (Auth::user()->role === 'General Admin')
        <h2>Data Arsip Seluruh</h2>
    @else
        <h2>Data Arsip <br>
            User : {{ Auth::user()->username }}</h2>
    @endif
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>No Surat</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Ukuran</th>
                <th>Tanggal Upload</th>
                <th>Users</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rowArsip as $index => $arsip)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $arsip->name_file }}</td>
                    <td>{{ $arsip->no_surat }}</td>
                    <td>{{ $arsip->judul }}</td>
                    <td>{{ $arsip->kategori }}</td>
                    <td>{{ $arsip->jenis_laporan }}</td>
                    <td><span
                            style="color: {{ $arsip->file_eksis == 'Ada' ? 'green' : 'red' }}">{{ $arsip->file_eksis }}</span>
                    </td>
                    <td>{{ $arsip->size_file }}</td>
                    <td>{{ $arsip->date_upload }}</td>
                    <td>{{ $arsip->user->username }} ({{ $arsip->user->role }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
