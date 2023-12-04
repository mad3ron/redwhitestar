<x-app-layout>
    <div class="mt-10">
        <h2 class="text-lg font-medium mr-auto">
            Create or Update Pemesanan
        </h2>
    </div>
    <div class="intro-y box py-10 sm:py-10 mt-5">
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row">
                        <div class="flex-1 mt-6 xl:mt-0">
                            <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-12 gap-4 gap-y-5">
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Pemesanan</label>
                                        <input id="nama_pemesan" type="text" name="nama_pemesan" value="{{ old('nama_pemesan') }}" class="form-control @error('nama_pemesan') text-red-700 @enderror" placeholder="Input Nama Pemesan" minlength="3" required>
                                        @error('nama_pemesan')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Phone</label>
                                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') text-red-700 @enderror" placeholder="Input phone" minlength="2" required>
                                        @error('phone')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Jenis Armada</label>
                                        <select id="armada_id" name="armada_id" class="tom-select select2" data-tags="true" required>
                                            <option value="">{{ __('Select Jenis Armada') }}</option>
                                            @foreach ($armadas as $armada)
                                                <option value="{{ $armada->id }}" {{ old('armada_id') == $armada->id ? 'selected' : '' }}>
                                                    {{ $armada->jenis_armada }} - {{ $armada->seat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('armada_id')
                                            <div class="text-theme-6 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label for="tujuan" class="form-label">Type Bus dan Tujuan</label>
                                        <select id="tujuan_id" name="tujuan_id" class="tom-select select2" data-tags="true" required>
                                            <option value="">{{ __('Select Tujuan') }}</option>
                                            @foreach ($tujuans as $tujuan)
                                                <option value="{{ $tujuan->id }}" data-harga-dasar="{{ $tujuan->harga_dasar }}" {{ old('tujuan_id') == $tujuan->id ? 'selected' : '' }}>
                                                    {{ $tujuan->armadas->jenis_armada }} - {{ $tujuan->tujuan }} - {{ $tujuan->pemakaian }} - {{ $tujuan->harga_dasar }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tujuan_id')
                                            <div class="text-theme-6 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="text" class="form-control" id="harga" name="harga" readonly>
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Tanggal Keberangkatan</label>
                                        <input id="tgl_brkt" type="date" name="tgl_brkt" value="{{ old('tgl_brkt') }}" class="form-control @error('tgl_brkt') text-red-700 @enderror" placeholder="Input Tanggal Keberangkatan" minlength="2" required>
                                        @error('tgl_brkt')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Tanggal Kepulangan</label>
                                        <input id="tgl_pulang" type="date" name="tgl_pulang" value="{{ old('tgl_pulang') }}" class="form-control @error('tgl_pulang') text-red-700 @enderror" placeholder="Input Tanggal Kepulangan" minlength="2" required>
                                        @error('tgl_pulang')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Jumlah Bis</label>
                                        <input id="jml_bis" type="text" name="jml_bis" value="{{ old('jml_bis') }}" class="form-control @error('jml_bis') text-red-700 @enderror" placeholder="Input Jumlah Bis" minlength="1" required>
                                        @error('jml_bis')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Alamat Jemput</label>
                                        <input id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" class="form-control @error('alamat') text-red-700 @enderror" placeholder="Input alamat" minlength="2" required>
                                        @error('alamat')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">Jam Penjemputan</label>
                                        <input type="time" name="jam_jemput" id="jam_jemput" value="{{ old('jam_jemput') }}" class="form-control" required>
                                        @error('jam_jemput')
                                            <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <label class="form-label">pool Pool</label>
                                        <select id="pool_id" name="pool_id" class="tom-select select2" data-tags="true" required>
                                            <option value="">{{ __('Select pool') }}</option>
                                            @foreach ($pools as $pool)
                                                <option value="{{ $pool->id }}" {{ old('pool_id') == $pool->id ? 'selected' : '' }}>
                                                    {{ $pool->nama_pool }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pool_id')
                                            <div class="text-theme-6 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <!-- User ID (Tersembunyi) -->
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                    <div class="intro-y col-span-12 sm:col-span-6">
                                        <div class="mt-5 sm:mt-10">
                                            <button id="pemesanan-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                            <a href="{{ route('pemesanan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const jenisArmadaSelect = document.getElementById('jenis_armada');
        const tujuanSelect = document.getElementById('tujuan');
        const hargaInput = document.getElementById('harga');

            jenisArmadaDropdown.addEventListener("change", function () {

                if (jenisArmadaDropdown.value === "jenis_armada_1") {
                    hargaInput.value = "Harga untuk jenis armada 1";
                } else if (jenisArmadaDropdown.value === "jenis_armada_2") {
                    hargaInput.value = "Harga untuk jenis armada 2";
                } else {
                    hargaInput.value = "";
                }
            });

            tujuanDropdown.addEventListener("change", function () {
                // Lakukan sesuatu saat tujuan berubah
                // Misalnya, periksa nilai tujuan yang dipilih
                // dan atur nilai hargaInput berdasarkan kondisi tertentu
                // Contoh:
                if (tujuanDropdown.value === "tujuan_1") {
                    hargaInput.value = "Harga untuk tujuan 1";
                } else if (tujuanDropdown.value === "tujuan_2") {
                    hargaInput.value = "Harga untuk tujuan 2";
                } else {
                    hargaInput.value = "";
                }
            });
        });
        </script>

    {{-- <script>
        // Mengambil elemen select tujuan
        const selectTujuan = document.getElementById('tujuan_id');

        // Mengambil elemen input harga
        const inputHarga = document.getElementById('harga');

        // Menambahkan event listener untuk mengisi harga saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Jika ada nilai terpilih pada dropdown tujuan
            if (selectTujuan.value) {
                // Mengambil nilai harga dari atribut data-harga pada opsi yang terpilih
                const selectedOption = selectTujuan.options[selectTujuan.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');

                // Mengisi input harga dengan harga dari pilihan yang terpilih
                inputHarga.value = harga;
            }
        });

        // Menambahkan event listener untuk mengubah harga saat pilihan tujuan berubah
        selectTujuan.addEventListener('change', function () {
            // Mengambil nilai harga dari atribut data-harga pada opsi yang dipilih
            const selectedOption = selectTujuan.options[selectTujuan.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');

            // Mengisi input harga dengan harga yang diambil dari pilihan
            inputHarga.value = harga;
        });
    </script> --}}
</x-app-layout>
