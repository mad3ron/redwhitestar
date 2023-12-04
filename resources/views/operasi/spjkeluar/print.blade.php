<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan SPJ Keluar</title>
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
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        h1, p {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Data Inventari Bis</h1>
{{--
    @foreach ($buses->groupBy('pools.nama_pool') as $pool => $busesInPool)
        <h2>Pool: {{ $pool }}</h2>
        @foreach($busesInPool->groupBy('rutes.koderute') as $rute => $ruteBuses)
            <h3>Rute: {{ $rute }}</h3> --}}
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nobody</th>
                        <th>Nopolisi</th>
                        <th>No Chassis</th>
                        <th>No Mesin</th>
                        <th>Merk</th>
                        <th>Tahun</th>
                        <th>Jenis</th>
                        <th>Seat</th>
                        <th>Kondisi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($ruteBuses as $bus)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bus->nobody }}</td>
                            <td>{{ $bus->nopolisi }}</td>
                            <td>{{ $bus->nochassis }}</td>
                            <td>{{ $bus->nomesin }}</td>
                            <td>{{ $bus->merk }}</td>
                            <td>{{ $bus->tahun }}</td>
                            <td>{{ $bus->jenis }}</td>
                            <td>{{ $bus->seat }}</td>
                            <td>{{ $bus->kondisi }}</td>
                            <td>{{ $bus->keterangan }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
            <div class="page-break"></div>
        @endforeach
    @endforeach
</body>
</html>
