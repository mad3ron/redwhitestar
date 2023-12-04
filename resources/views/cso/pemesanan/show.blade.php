<x-app-layout>
    <div class="mt-8">
        <a href="{{ route('pemesanan.index') }}" class="text-xl text-warning font-medium leading-none mt-3">
            Pembayaran Konsumen
        </a>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="intro-y mt-5">
            <div class="col-span-12 uppercase text-success font-bold">Nama Pemesan : {{ $pemesanan->nama_pemesan }} </div>
            <div class="col-span-12 uppercase">Tujuan : {{ $pemesanan->tujuans->tujuan }} - {{ $pemesanan->tujuans->pemakaian }}</div>
            <div class="col-span-12 uppercase font-bold">Harga Dasar : {{ number_format($pemesanan->harga, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Jumlah Bis : {{  number_format($jmlBis, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Biaya Jemput : {{ number_format( $biayaJemput, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Discount: {{ number_format( $jmlDiscount, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Total Harga : {{ number_format($jumlahPembayaran, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase">Uang Diterima : {{ number_format($baruBayar, 0, ',', '.') }} </div>
            <div class="col-span-12 uppercase font-semibold">Sisa Pembayaran :
                {{ $sisaPembayaran <= 0 ? '' : number_format($sisaPembayaran, 0, ',', '.') }}
            </div>
            <div class="col-span-12 uppercase">Status : {{ $status }} </div>
            <div class="col-span-12 uppercase text-success">User : {{ $pemesanan->user->name }} </div>
        </div>

        @if ($pemesanan && $pemesanan->count() > 0)
            <div class="intro-y card">
                <div class="card-body mt-8">
                    <h6 class="text-lg text-success font-medium leading-none mt-3">Data Pembayaran</h6>
                    <table class="intro-y table table-bordered">
                        <thead>
                            <tr>
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
                                @if ($payment)
                                    <tr>
                                        <td>{{ $payment->nomorPembayaran }}</td>
                                        <td>{{ $payment->tgl_bayar }}</td>
                                        <td>{{ $payment->kode_pembayaran }}</td>
                                        <td>{{ number_format($payment->jml_bayar, 0, ',', '.') }}</td>
                                        <td>{{ $payment->keterangan }}</td>
                                        <td>{{ $payment->user->name }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-danger">Pembayaran tidak ditemukan.</div>
        @endif

        @if ($jumlahInvoice >= 3)
            <div class="alert alert-warning">
                <h4>Jumlah Invoice: {{ number_format($jumlahInvoice, 0, ',', '.') }}</h4>
            </div>
        @else
            @if ($status === 'BELUM LUNAS')
                <div class="alert alert-danger">
                    <h4>Jumlah Invoice: {{ number_format($jumlahInvoice, 0, ',', '.') }}</h4>
                    <p>Konsumen belum lunas.</p>
                </div>
            @else
                <div class="alert alert-info">
                    <p>Tidak ada data pembayaran.</p>
                </div>
            @endif
        @endif


        <div class="mt-5 sm:mt-10">
            <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mr-2">Bayar</a>
            <a href="{{ route('pemesanan.invoice', ['id' => $pemesanan->id]) }}" class="btn btn-primary mr-2" target="_blank">Print Invoice</a>
            <a href="{{ route('pemesanan.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</x-app-layout>
