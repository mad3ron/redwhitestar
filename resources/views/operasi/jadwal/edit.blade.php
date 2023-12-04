<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('jadwal.index') }}" class="intro-y text-lg font-medium mr-auto">
            Edit Jadwal Bis
        </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('jadwal.update', $jadwals->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Tanggal Spj Keluar</label>
                                <input id="tanggal" type="date" name="tanggal" value="{{ $jadwals->tanggal }}" class="form-control @error('tanggal') text-red-700 @enderror" placeholder="Input Tanggal" required>
                                @error('tanggal')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Nomor Body</label>
                                <select id="bis_id" name="bis_id" class="tom-select" required>
                                    <option value="">{{ __('Select Nomor Body') }}</option>
                                        @foreach ($bis as $data)
                                            <option value="{{ $data->id }}" {{ old('bis_id', $jadwals->bis_id) == $data->id ? 'selected' : '' }}>
                                                {{ $data->nobody }} - {{ $data->nopolisi }} - {{ $data->rutes->koderute }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('bis_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Posisi</label>
                                <select id="posisi_id" name="posisi_id" class="tom-select" required>
                                        @foreach ($posisis as $posisi)
                                            <option value="{{ $posisi->id }}" {{ old('posisi_id', $jadwals->posisi_id) == $posisi->id ? 'selected' : '' }}>
                                                {{ $posisi->name }} - {{ $posisi->kodeposisi }}
                                            </option>
                                        @endforeach
                                </select>
                                @error('posisi_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Pemesan</label>
                                <select id="pemesanan_id" name="pemesanan_id" class="tom-select" data-tags="true" required>
                                    <option value="">Pilih Pemesan</option>
                                    @foreach ($pemesanans as $pemesanan)
                                        @if ($pemesanan->status === 'lunas') {{-- Perubahan di sini --}}
                                            <option value="{{ $pemesanan->id }}" {{ old('pemesanan_id', $jadwals->pemesanan_id) == $pemesanan->id ? 'selected' : '' }}>
                                                {{ $pemesanan->nama_pemesan }} - {{ $pemesanan->tujuans->tujuan }} {{ $pemesanan->sisaPembayaran }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('pemesanan_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label class="form-label">Keterangan</label>
                                <input id="keterangan" type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $jadwals->keterangan) }}">
                            </div>
                              <!-- User ID (Tersembunyi) -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('jadwal.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
