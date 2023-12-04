<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('spj-masuk.index') }}" class="intro-y text-lg font-medium mr-auto">
                Input SPJ Masuk
            </a>
        </div>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
            <div class="intro-y box py-10 sm:py-20 mt-3">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('spj-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-2">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Spjr</label>
                            <select id="nospj_id" name="nospj_id" class="tom-select" required>
                                <option value="">{{ __('Select No Spj Keluar') }}</option>
                                @foreach ($spjkeluars as $data)
                                    <option value="{{ $data->id }}" {{ $data->id == $data->nospj_id ? 'selected' : '' }}>
                                        {{ $data->nomorspj }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nospj_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Masuk</label>
                            <input id="tgl_masuk" type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk', date('Y-m-d')) }}" required>
                            @error('tgl_masuk')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Posisi</label>
                            <select id="posisi_id" name="posisi_id" class="tom-select" required>
                                    @foreach ($posisis as $posisi)
                                        <option value="{{ $posisi->id }}" {{ old('posisi_id') == $posisi->id ? 'selected' : '' }}>
                                            {{ $posisi->name }} - {{ $posisi->kodeposisi }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('posisi_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">KM Masuk</label>
                            <input id="kmmasuk" type="number" name="kmmasuk" class="form-control" value="{{ old('kmmasuk') ?? 0 }}" required>
                            @error('kmmasuk')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Biaya BBM</label>
                            <input id="biaya_bbm" type="number" name="biaya_bbm" class="form-control" value="{{ old('biaya_bbm') ?? 0 }}" required>
                            @error('biaya_bbm')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Uang Makan</label>
                            <input id="uang_makan" type="number" name="uang_makan" class="form-control" value="{{ old('uang_makan') ?? 0 }}" required>
                            @error('uang_makan')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Biaya Tol</label>
                            <input id="biaya_tol" type="number" name="biaya_tol" class="form-control" value="{{ old('biaya_tol') ?? 0 }}" required>
                            @error('biaya_tol')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Parkir</label>
                            <input id="parkir" type="number" name="parkir" class="form-control" value="{{ old('parkir') ?? 0 }}" required>
                            @error('parkir')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Biaya Lain-lain</label>
                            <input id="biaya_lain" type="number" name="biaya_lain" class="form-control" value="{{ old('biaya_lain') ?? 0 }}" required>
                            @error('biaya_lain')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan_spjmasuk" type="text" name="keterangan_spjmasuk" class="form-control" value="{{ old('keterangan_spjmasuk') }}">
                        </div>
                         <!-- User ID (Tersembunyi) -->
                         <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                        <!-- Button -->
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <div class="mt-5 sm:mt-5">
                                <button id="bis-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('spj-masuk.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
