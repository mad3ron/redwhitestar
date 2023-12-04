<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Kelurahan</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: justify;
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
    <h1>Daftar Kelurahan</h1>
    @if (!empty($search))
        <p>Tentukan Halaman yang akan di Print: {{ $search }}</p>
    @endif
    @foreach ($kelurahans->chunk(100) as $chunk)
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>Kelurahan</th>
        <th>Kecamatan</th>
        <th>Dapil</th>
        <th>Kota/Kabupaten</th>
        <th>Provinsi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($chunk as $kelurahan)
        <tr>
          <td>{{ $kelurahan->nomor_urut }}</td>
          <td>{{ $kelurahan->name }}</td>
          <td>{{ $kelurahan->kecamatan }}</td>
          <td>{{ $kelurahan->dapil }}</td>
          <td>{{ $kelurahan->kabkota }}</td>
          <td>{{ $kelurahan->provinsi }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <br>
@endforeach

{{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
    {{ $kelurahans->links() }}
</div> --}}
</body>
</html>
