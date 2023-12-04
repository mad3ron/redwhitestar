<x-app-layout>
    <div class="mt-10">
    <a href="{{ route('spj-keluar.index') }}" class="intro-y text-lg font-medium mr-auto">
        Edit SPJ Keluar
    </a>
    <div class="p-5">
        <div class="intro-y box py-10 sm:py-10 mt-5">
            <div class="px-5 sm:px-10 ">
                <form method="POST" action="{{ route('spj-keluar.update', $spjkeluar->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-4 gap-y-5">
                        {{-- <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor SPJ Keluar</label>
                            <input type="text" name="nospjkeluar" id="nospjkeluar" class="form-control" value="{{ $nospjkeluar }}" readonly>
                            @error('nospjkeluar')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Spj Keluar</label>
                            <input id="tgl_klr" type="date" name="tgl_klr" value="{{ $spjkeluar->tgl_klr instanceof \Carbon\Carbon ? $spjkeluar->tgl_klr->format('Y-m-d') : $spjkeluar->tgl_klr ?? date('Y-m-d') }}" class="form-control @error('tgl_klr') text-red-700 @enderror" placeholder="Input Tanggal SPJ Keluar" required>
                            @error('tgl_klr')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pemesan</label>
                            <select id="nopesan_id" name="nopesan_id" class="tom-select" data-tags="true" required>
                                <option value="">Pilih Pemesan</option>
                                @foreach ($pemesanans as $pemesanan)
                                    @if ($pemesanan->status === 'lunas') {{-- Perubahan di sini --}}
                                        <option value="{{ $pemesanan->id }}" {{ old('nopesan_id', $spjkeluar->nopesan_id) == $pemesanan->id ? 'selected' : '' }}>
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
                            <label class="form-label">Posisi</label>
                            <select id="posisi_id" name="posisi_id" class="tom-select" required>
                                    @foreach ($posisis as $posisi)
                                        <option value="{{ $posisi->id }}" {{ old('posisi_id', $spjkeluar->posisi_id) == $posisi->id ? 'selected' : '' }}>
                                            {{ $posisi->name }} - {{ $posisi->kodeposisi }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('posisi_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Body</label>
                            <select id="bis_id" name="bis_id" class="tom-select" required>
                                <option value="">{{ __('Select Nomor Body') }}</option>
                                    @foreach ($bis as $data)
                                        <option value="{{ $data->id }}" {{ old('bis_id', $spjkeluar->bis_id) == $data->id ? 'selected' : '' }}>
                                            {{ $data->nobody }} - {{ $data->nopolisi }} - {{ $data->rutes->koderute }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('bis_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Polisi</label>
                            <input id="nopolisi" type="text" name="nopolisi" class="form-control" value="{{ old('nopolisi', $spjkeluar->nopolisi) }}" required>
                            @error('nopolisi')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Rute</label>
                            <select id="rute_id" name="rute_id" class="tom-select" required>
                                <option value="">{{ __('Select Rute') }}</option>
                                    @foreach ($rutes as $data)
                                        <option value="{{ $data->id }}" {{ old('rute_id', $spjkeluar->rute_id) == $data->id ? 'selected' : '' }}>
                                            {{ $data->koderute }} - {{ $data->namarute }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('rute_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pool</label>
                            <select id="pool_id" name="pool_id" class="tom-select" required>
                                <option value="">{{ __('Select Pool') }}</option>
                                    @foreach ($pools as $data)
                                        <option value="{{ $data->id }}" {{ old('pool_id', $spjkeluar->pool_id) == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama_pool }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('pool_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pengemudi</label>
                            <select id="nopengemudi_id" name="nopengemudi_id" class="tom-select" required>
                                <option value="">{{ __('Select Pengemudi') }}</option>
                                    @foreach ($pengemudis as $data)
                                        <option value="{{ $data->id }}" {{ old('nopengemudi_id', $spjkeluar->nopengemudi_id) == $data->id ? 'selected' : '' }}>
                                            {{ $data->nopengemudi }} - {{ $data->biodata->nama }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('nopengemudi_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Kondektur</label>
                            <select id="nokondektur_id" name="nokondektur_id" class="tom-select" required>
                                <option value="">{{ __('Select Kondektur') }}</option>
                                    @foreach ($kondekturs as $data)
                                        <option value="{{ $data->id }}" {{ old('nokondektur_id', $spjkeluar->nokondektur_id) == $data->id ? 'selected' : '' }}>
                                            {{ $data->nokondektur }} - {{ $data->biodata->nama }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('nokondektur_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Uang Jalan</label>
                            <input id="uang_jalan" type="text" name="uang_jalan" value="{{ old('uang_jalan', $spjkeluar->uang_jalan) }}" class="form-control @error('uang_jalan') text-red-700 @enderror" placeholder="Input Uang Jalan"required>
                            @error('uang_jalan')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">KM Keluar</label>
                            <input id="kmkeluar" type="text" name="kmkeluar" value="{{ old('kmkeluar', $spjkeluar->kmkeluar) ?? 0 }}" class="form-control @error('kmkeluar') text-red-700 @enderror" placeholder="Input KM Keluar"required>
                            @error('kmkeluar')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan_spjklr" type="text" name="keterangan_spjklr" class="form-control" value="{{ old('keterangan_spjklr', $spjkeluar->keterangan_spjklr) }}">
                        </div>
                          <!-- User ID (Tersembunyi) -->
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <div class="intro-y col-span-12 sm:col-span-12">
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                            <a href="{{ route('spj-keluar.index') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
