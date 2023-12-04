<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('pembayaran.index') }}" class="intro-y text-lg font-medium mr-auto">
            Create Pembayaran
        </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Nomor Pembayaran</label>
                                <input type="text" name="nomorPembayaran" id="nomorPembayaran" class="form-control" value="{{ $nomorPembayaran }}" readonly>
                                @error('nomorPembayaran')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Pemesan</label>
                                <select id="nopesan_id" name="nopesan_id" class="tom-select select2" data-tags="true" required>
                                    <option value="">Pilih Pemesan</option>
                                    @foreach ($pemesanans as $pemesanan)
                                        @if ($pemesanan->status === 'belum lunas') {{-- Perubahan di sini --}}
                                            <option value="{{ $pemesanan->id }}" {{ old('nopesan_id') == $pemesanan->id ? 'selected' : '' }}>
                                                {{ $pemesanan->nama_pemesan }} - {{ $pemesanan->tujuans->tujuan }} {{ $pemesanan->sisaPembayaran }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('nopesan_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input id="tgl_bayar" type="date" name="tgl_bayar" value="{{ old('tgl_bayar', date('Y-m-d')) }}" class="form-control @error('tgl_bayar') text-red-700 @enderror" placeholder="Input Tanggal Pembayaran" required>
                                @error('tgl_bayar')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div id="kode_pembayaran" class="input-group-text">Kode Pembayaran</div>
                                <select id="kode_pembayaran" name="kode_pembayaran" data-search="true" class="tom-select w-full" required>
                                    <option value="">Select kode_pembayaran</option>
                                        <option value="Uang Muka" {{ old('kode_pembayaran') == 'Uang Muka' ? 'selected' : '' }}>Uang Muka</option>
                                        <option value="Uang Muka 2" {{ old('kode_pembayaran') == 'Uang Muka 2' ? 'selected' : '' }}>Uang Muka 2</option>
                                        <option value="Uang Muka 3" {{ old('kode_pembayaran') == 'Uang Muka 3' ? 'selected' : '' }}>Uang Muka 3</option>
                                        <option value="Pelunasan" {{ old('kode_pembayaran') == 'Pelunasan' ? 'selected' : '' }}>Pelunasan</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input id="jml_bayar" type="text" name="jml_bayar" value="{{ old('jml_bayar') }}" class="form-control @error('jml_bayar') text-red-700 @enderror" placeholder="Input Jumlah Pembayaran"required>
                                @error('jml_bayar')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Discount</label>
                                <input id="discount" type="text" name="discount" value="{{ old('discount') ?? 0 }}" class="form-control @error('discount') text-red-700 @enderror" placeholder="Input Discount"required>
                                @error('discount')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div id="jenis_bayar" class="input-group-text">Jenis Pembayaran</div>
                                <select id="jenis_bayar" name="jenis_bayar" data-search="true" class="tom-select w-full" required>
                                    <option value="">Select Jenis Pembayaran</option>
                                        <option value="CASH" {{ old('jenis_bayar') == 'CASH' ? 'selected' : '' }}>CASH</option>
                                        <option value="TRANSFER" {{ old('jenis_bayar') == 'TRANSFER' ? 'selected' : '' }}>TRANSFER</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label class="form-label">Keterangan</label>
                                <input id="keterangan" type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}">
                            </div>
                              <!-- User ID (Tersembunyi) -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <button id="pembayaran-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('pembayaran.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</x-app-layout>
