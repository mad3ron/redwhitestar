<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Pemesanan Bus Wisata</title>
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
    <h1>Data Pemesanan Bus</h1>
    @php
        $currentPool = null;
        $currentArmada = null;
        $subtotal = 0;
        $total = 0;
    @endphp
    @foreach ($data as $item)

        @if ($loop->first || $item->nama_pool !== $currentPool)
            @php
                $currentPool = $item->nama_pool;
            @endphp
            <h2>Pool: {{ $item->nama_pool }}</h2>
        @endif
        @if ($loop->first || $item->jenis_armada !== $currentArmada)
            @php
                $currentArmada = $item->jenis_armada;
            @endphp

            <h3>Jenis Armada: {{ $currentArmada }}</h3>

            <table>
                <!-- Header tabel -->
                <thead>
                    <tr>
                        <th>Nama.Pemesan</th>
                        <th>Phone</th>
                        <th>Tujuan</th>
                        <th>Tanggal Brkt</th>
                        <th>Tanggal Pulang</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Jml Bis</th>
                        <th>Total Harga</th>
                        <th>Alamat Jemput</th>
                        <th>Jam Jemput</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
        @endif
                    <tr>
                        <td>{{ $item->nama_pemesan }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->tujuan }}</td>
                        <td>{{ $item->tgl_brkt }}</td>
                        <td>{{ $item->tgl_pulang }}</td>
                        <td>{{ $item->durasi_hari }} hari</td>
                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->jml_bis }}</td>
                        <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->jam_jemput }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                    @if ($loop->last || $item->jenis_armada !== $data[$loop->index + 1]->jenis_armada)
                </tbody>
            </table>
                    @endif
                @php
                $subtotal += $item->total_harga;
                $total += $item->total_harga;
                @endphp
    @endforeach
    <!-- Tambahkan total terakhir setelah loop -->
    <p>Subtotal: {{ number_format($subtotal, 0, ',', '.') }}</p>
    <p>Total: {{ number_format($total, 0, ',', '.') }}</p>
</body>
</html>
