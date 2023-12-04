<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Biodata Karyawan</title>
    <style>
        h2, h3 {
            margin-top: 0;
        }

        table {
            margin-bottom: 20px;
        }

        .page-break {
            page-break-after: always;
            clear: both;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ddd;
        }

        h1, p {
            text-align: center;
        }

        body {
            font-size: 14px;
        }

        .page-break {
        page-break-after: always;
        clear: both;
    }

    .my-element {
        page-break-inside: avoid;
    }

    .avoid-last-page {
        page-break-after: avoid;
        }
    </style>
</head>
<body>
    <h1>Biodata Karyawan</h1>

    @foreach ($biodata->groupBy('kotalahirs.tempat_lahir') as $tempat_lahir => $biodataIntempatlahir)
        <h2>Tempat Lahir: {{ $tempat_lahir }}</h2>
        @foreach($biodataIntempatlahir->groupBy('kelurahans.name') as $kelurahan => $biodataLahir)
            <h3>Kelurahan: {{ $kelurahan }}</h3>

                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor KTP</th>
                            <th>No.Kartu.Keluarga</th>
                            <th>Nama.Karyawan</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal.Lahir</th>
                            <th>Status</th>
                            <th>Agama</th>
                            <th>Jenis</th>
                            <th>Alamat.Karyawan</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Kelurahan</th>
                            <th>Kabupaten</th>
                            <th>Keaktifan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($biodataLahir as $biodata)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $biodata->nik }}</td>
                                <td>{{ $biodata->nokk }}</td>
                                <td>{{ $biodata->nama }}</td>
                                <td>{{ $biodata->kotalahirs->tempat_lahir }}</td>
                                <td>{{ $biodata->tgl_lahir }}</td>
                                <td>{{ $biodata->status }}</td>
                                <td>{{ $biodata->agama }}</td>
                                <td>{{ $biodata->jenis }}</td>
                                <td>{{ $biodata->alamat }}</td>
                                <td>{{ $biodata->rt }}</td>
                                <td>{{ $biodata->rw }}</td>
                                <td>{{ $biodata->kelurahans->name }} {{ $biodata->kelurahans->kecamatan }}</td>
                                <td>{{ $biodata->kelurahans->kabkota }}</td>
                                <td>{{ $biodata->is_visible }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            {{-- <div class="page-break"></div> --}}
            <div class="my-element avoid-last-page"></div>
        @endforeach
    @endforeach

</body>
</html>
