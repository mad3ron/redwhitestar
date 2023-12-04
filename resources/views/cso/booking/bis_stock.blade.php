<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hitung Stok Bis Tersedia</div>
                    <div class="card-body">
                        <form method="post" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal">Tanggal:</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung Stok Bis</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (isset($bisTersediaPadaTanggal))
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Stok Bis Tersedia</div>
                        <div class="card-body">
                            <p>Tanggal: {{ $tanggal }}</p>
                            <p>Jumlah Bis Tersedia: {{ $bisTersediaPadaTanggal }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
