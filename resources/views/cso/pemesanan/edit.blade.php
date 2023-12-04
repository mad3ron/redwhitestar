<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('pemesanan.index') }}" class="intro-y text-lg font-medium mr-auto">
            Edit pemesanan
        </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form method="POST" action="{{ route('pemesanan.update', $pemesanan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Tanggal Pesan</label>
                                <input id="tgl_pesan" type="date" name="tgl_pesan" value="{{ $pemesanan->tgl_pesan }}" class="form-control @error('tgl_pesan') text-red-700 @enderror" placeholder="Input Tanggal Pesan" required>
                                @error('tgl_pesan')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Pemesanan</label>
                                <input id="nama_pemesan" type="text" name="nama_pemesan" value="{{ $pemesanan->nama_pemesan }}" class="form-control @error('nama_pemesan') text-red-700 @enderror" placeholder="Input Nama Pemesanan" minlength="3" required>
                                @error('nama_pemesan')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Phone</label>
                                <input id="phone" type="text" name="phone" value="{{ $pemesanan->phone }}" class="form-control @error('phone') text-red-700 @enderror" placeholder="Input phone" minlength="2" required>
                                @error('phone')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jenis Armada</label>
                                <select id="armada_id" name="armada_id" class="tom-select select2" data-tags="true" required>
                                    <option value="">{{ __('Select Jenis Armada') }}</option>
                                    @foreach ($armadas as $armada)
                                        <option value="{{ $armada->id }}" {{ old('armada_id', $pemesanan->armada_id) == $armada->id ? 'selected' : '' }}>
                                            {{ $armada->jenis_armada }} - {{ $armada->seat }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('armada_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <select id="tujuan_id" name="tujuan_id" class="tom-select select2" data-tags="true" required>
                                    <option value="">{{ __('Select Tujuan') }}</option>
                                    @foreach ($tujuans as $tujuan)
                                        @php
                                            $tujuanLabel = $tujuan->tujuan;
                                            if ($tujuan->harga_dasar) {
                                                $tujuanLabel .= ' - ' . $tujuan->pemakaian . ' - ' . $tujuan->harga_dasar;
                                            }
                                        @endphp
                                        <option value="{{ $tujuan->id }}" {{ old('tujuan_id', $pemesanan->tujuan_id) == $tujuan->id ? 'selected' : '' }}>
                                            {{ $tujuanLabel }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="harga" class="form-label">Harga</label>
                                <input id="harga" type="text" name="harga" value="{{ old('harga', $pemesanan->harga) }}" class="form-control">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jumlah Bis</label>
                                <input id="jml_bis" type="text" name="jml_bis" value="{{ $pemesanan->jml_bis }}" class="form-control @error('jml_bis') text-red-700 @enderror" placeholder="Input Jumlah Bis" minlength="1" required>
                                @error('jml_bis')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Biaya Jemput</label>
                                <input id="biaya_jemput" type="text" name="biaya_jemput" value="{{ $pemesanan->biaya_jemput }}" class="form-control @error('biaya_jemput') text-red-700 @enderror" placeholder="Input Biaya Jemput" minlength="1" required>
                                @error('biaya_jemput')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Tanggal Keberangkatan</label>
                                <input id="tgl_brkt" type="date" name="tgl_brkt" value="{{ $pemesanan->tgl_brkt }}" class="form-control @error('tgl_brkt') text-red-700 @enderror" placeholder="Input Tanggal Keberangkatan" minlength="2" required>
                                @error('tgl_brkt')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Tanggal Kepulangan</label>
                                <input id="tgl_pulang" type="date" name="tgl_pulang" value="{{ $pemesanan->tgl_pulang }}" class="form-control @error('tgl_pulang') text-red-700 @enderror" placeholder="Input Tanggal Kepulangan" minlength="2" required>
                                @error('tgl_pulang')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Alamat Jemput</label>
                                <input id="alamat" type="text" name="alamat" value="{{ $pemesanan->alamat }}" class="form-control @error('alamat') text-red-700 @enderror" placeholder="Input alamat" minlength="2" required>
                                @error('alamat')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jam Penjemputan</label>
                                <input id="jam_jemput" type="time" name="jam_jemput" value="{{ $pemesanan->jam_jemput }}" class="form-control @error('jam_jemput') text-red-700 @enderror" required>
                                @error('jam_jemput')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Pool</label>
                                <select id="pool_id" name="pool_id" class="tom-select select2" data-tags="true" required>
                                    <option value="">{{ __('Select pool') }}</option>
                                    @foreach ($pools as $pool)
                                        <option value="{{ $pool->id }}" {{ old('pool_id', $pemesanan->pool_id) == $pool->id ? 'selected' : '' }}>
                                            {{ $pool->nama_pool }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pool_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Status Pelunasan</label>
                                <select id="status" name="status" data-search="true" class="tom-select" required>
                                    <option value="">Select Jenis</option>
                                        <option value="belum lunas" {{ $pemesanan->status == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                        <option value="lunas" {{ $pemesanan->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </div>

                             <!-- User ID (Tersembunyi) -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <button id="pemesanan-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('pemesanan.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
