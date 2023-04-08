<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Absensi</title>
    <style>
        table {
            margin: 0 auto;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 4px;
        }

        main h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    {{-- HEADER --}}
    <header style="width: 100%;">
        <img width="150" style="background-color: black; padding: 8px;" src="{{ asset('img/logo_hd.png') }}"
            alt="VENTRUE">
        <div style="margin-top: 24px;">
            <div style="margin: 12px 0;">
                <span style="display: inline-block;width: 120px;">Nama Acara</span>
                <span>: {{ $event->name }}</span>
            </div>
            <div style="margin: 12px 0;">
                <span style="display: inline-block;width: 120px;">Penyelenggara</span>
                <span>: {{ $event->organization->name }}</span>
            </div>
            <div style="margin: 12px 0;">
                <span style="display: inline-block;width: 120px;">Waktu</span>
                <span>: {{ \Carbon\Carbon::parse($event->start)->translatedFormat('d F Y H:i') }}</span>
            </div>
        </div>
    </header>

    {{-- TABLE --}}
    <main>
        <h2>DAFTAR ABSENSI</h2>
        <table>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Fakultas</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
            </tr>
            @foreach ($students as $student)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration . '.' }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->sid }}</td>
                    <td>{{ $student->faculty->acronym }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->user->email }}</td>
                </tr>
            @endforeach
        </table>
    </main>
</body>

</html>
