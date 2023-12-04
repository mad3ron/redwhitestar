<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>INVOICE</title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            h1,h2,h3,h4,h5,h6,p,span,div {
                font-family: Arial, Helvetica, sans-serif;
                font-size:14px;
                font-weight: normal;
            }

            th,td {
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size:12px;
            }

            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }

            .panel-default {
                border-color: #ddd;
            }

            .panel-body {
                padding: 15px;
            }

            table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 0px;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;

            }

            thead  {
                text-align: left;
                display: table-header-group;
                vertical-align: middle;
            }

            th, td  {
                border: 1px solid #ddd;
                padding: 6px;
            }

            .well {
                min-height: 20px;
                padding: 19px;
                margin-bottom: 20px;
                background-color: #f5f5f5;
                border: 1px solid #e3e3e3;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            }
        </style>
        {{-- @if($invoice->duplicate_header)
            <style>
                @page { margin-top: 140px;}
                header {
                    top: -100px;
                    position: fixed;
                }
            </style>
        @endif --}}
    </head>
<body>
    <h1>INVOICE</h1>
    <header>
        <div style="position:absolute; left:0pt; width:250pt;">
            <p><h1>PT. PRIMAJASA PERDANARAYA</h1></p>
            <p>{{ $pemesanan->pools->nama_pool }}</p>
            <p>{{ $pemesanan->pools->alamat }}</p>
        </div>
    </header>
    <div style="margin-left: 300pt;">
        <h4>Customer Details:</h4>
        <div class="panel panel-default">
            <div class="panel-body">

                <div class="col-span-12 uppercase text-success font-bold">Nama Pemesan : {{ $pemesanan->nama_pemesan }} </div>
                <div class="col-span-12 uppercase">Tujuan : {{ $pemesanan->tujuans->tujuan }} - {{ $pemesanan->tujuans->pemakaian }}</div>
                <div class="col-span-12 uppercase font-bold">Harga Dasar : {{ number_format($pemesanan->harga, 0, ',', '.') }} </div>
                <div class="col-span-12 uppercase">Jumlah Bis : {{  number_format($pemesanan->jml_bis, 0, ',', '.') }} </div>
                <div class="col-span-12 uppercase">Biaya Jemput : {{ number_format( $pemesanan->biaya_jemput, 0, ',', '.') }} </div>
                <div class="col-span-12 uppercase">Discount: {{ number_format( $pemesanan->pembayaran->sum('discount'), 0, ',', '.') }} </div>
                <div class="col-span-12 uppercase">Total Harga :
                    {{ number_format(($pemesanan->harga * $pemesanan->jml_bis) + $pemesanan->biaya_jemput -
                    $pemesanan->pembayaran->sum('discount'), 0, ',', '.') }} </div>
                <div class="col-span-12 uppercase">Uang Diterima : {{ number_format( $pemesanan->pembayaran->sum('jml_bayar'), 0, ',', '.') }} </div>
                <div class="col-span-12 uppercase font-semibold">Sisa Pembayaran :
                    {{ number_format(($pemesanan->harga * $pemesanan->jml_bis) + $pemesanan->biaya_jemput -
                        $pemesanan->pembayaran->sum('discount') - $pemesanan->pembayaran->sum('jml_bayar'), 0, ',', '.') }}
                </div>
                <div class="col-span-12 uppercase">Status : {{ $status }} </div>
            </div>
        </div>
    </div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Pembayaran</th>
                    <th>Tanggal Bayar</th>
                    <th>Kode Pembayaran</th>
                    <th>Jumlah Bayar</th>
                    <th>Keterangan</th>
                    <th>Penerima</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanan->pembayaran as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->nomorPembayaran }}</td>
                        <td>{{ $payment->tgl_bayar }}</td>
                        <td>{{ $payment->kode_pembayaran }}</td>
                        <td>{{ number_format($payment->jml_bayar, 0, ',', '.') }}</td>
                        <td>{{ $payment->keterangan }}</td>
                        <td>{{ $payment->user->name }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td><b>TOTAL</b></td>
                    <td><b>{{ number_format($pemesanan->pembayaran->sum('jml_bayar'), 0, ',', '.') }}</b></td>
                    <td></td>
                    {{-- <p>Total Bayar (Terbilang) : {{ terbilang($pemesanan->pembayaran->sum('jml_bayar')) }}</p> --}}
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="page-break"></div>
</body>
</html>
