<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventory Rute</title>
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

    @foreach ($rutes->groupBy('pools.name') as $pool => $ruteesInPool)
        <h2>Pool: {{ $pool }}</h2>
        {{-- @foreach($ruteesInPool->groupBy('rutes.name') as $rute => $ruterutees)
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
                    @foreach ($ruterutees as $rute)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rute->nobody }}</td>
                            <td>{{ $rute->nopolisi }}</td>
                            <td>{{ $rute->nochassis }}</td>
                            <td>{{ $rute->nomesin }}</td>
                            <td>{{ $rute->merk }}</td>
                            <td>{{ $rute->tahun }}</td>
                            <td>{{ $rute->jenis }}</td>
                            <td>{{ $rute->seat }}</td>
                            <td>{{ $rute->kondisi }}</td>
                            <td>{{ $rute->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="page-break"></div>
        @endforeach
    @endforeach
</body>
</html>
