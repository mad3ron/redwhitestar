<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('kondektur.index') }}" class="intro-y text-lg font-medium mr-auto">
                kondektur
            </a>
        </div>
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
            <div class="intro-y box py-10 sm:py-20 mt-3">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('kondektur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-2">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="new-password" required>
                            <div id="nik-suggestion-list"></div>
                            @error('nik')
                                <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">No. Kondektur</label>
                            <input type="text" id="nokondektur" name="nokondektur" class="form-control" value="{{ old('nokondektur') }}">

                            @error('nokondektur')
                            <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Rute</label>
                            <select id="rute_id" name="rute_id" class="tom-select w-full" required>
                                <option value="">{{ __('Select Rute') }}</option>
                                @if (count($rutes) > 0)
                                    @foreach ($rutes as $rute)
                                        <option value="{{ $rute->id }}" {{ $rute->id == old('rute_id', $pengemudi->rute_id ?? '') ? 'selected' : '' }}>
                                            {{ $rute->koderute }} - {{ $rute->namarute }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal KP</label>
                            <input id="tgl_kp" type="date" name="tgl_kp" value="{{ old('tgl_kp') }}" class="form-control @error('nobody') is-invalid @enderror" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Jamsostek</label>
                            <input id="nojamsostek" name="nojamsostek" type="text" value="{{ old('nojamsostek') }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Jamsostek</label>
                            <input id="tgl_jamsos" name="tgl_jamsos" type="date" value="{{ old('tgl_jamsos') }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <div id="status" class="input-group-text">Status</div>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="">Select Status</option>
                                    <option value="AKTIF" {{ old('status') == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                                    <option value="BERMASALAH" {{ old('status') == 'BERMASALAH' ? 'selected' : '' }}>BERMASALAH</option>
                                    <option value="NONAKTIF" {{ old('status') == 'NONAKTIF' ? 'selected' : '' }}>NONAKTIF</option>
                                    <option value="KELUAR" {{ old('status') == 'KELUAR' ? 'selected' : '' }}>KELUAR</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan" name="keterangan" type="text" value="{{ old('keterangan') }}" class="form-control">
                        </div>
                        <!---Button-->
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <button type="button" onclick="window.location.href='{{ route('kondektur.index') }}'" class="btn btn-secondary w-20">Cancel</button>
                            <button type="submit" class="btn btn-primary w-20 mr-auto"> Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        // Seleksi elemen input "NIK" dan daftar saran
        const nikInput = document.getElementById('nik');
        const suggestionList = document.getElementById('nik-suggestion-list');

        // Event handler saat pengguna memasukkan input
        nikInput.addEventListener('input', function () {
          const nikValue = nikInput.value;
          const apiUrl = `/search-nik?query=${nikValue}`;

          // Gunakan fetch API atau library AJAX seperti Axios
          fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
              // Hapus saran-saran sebelumnya
              suggestionList.innerHTML = '';

              // Tambahkan saran-saran baru
              data.data.forEach((suggestion) => {
                const suggestionItem = document.createElement('div');
                suggestionItem.textContent = `${suggestion.nik} - ${suggestion.nama}`;

                // Event handler saat salah satu saran dipilih
                suggestionItem.addEventListener('click', function () {
                  nikInput.value = suggestion.nik;
                  suggestionList.innerHTML = ''; // Tutup daftar saran
                });

                suggestionList.appendChild(suggestionItem);
              });
            });
        });

        // Seleksi elemen input, kotak centang, dan pesan notifikasi
        const nikInput = document.getElementById('nik');
        const autoFillCheckbox = document.getElementById('autoFillCheckbox');
        const nikNotFoundMessage = document.getElementById('nik-not-found');

        // Event handler saat kotak centang diubah
        autoFillCheckbox.addEventListener('change', function () {
            if (autoFillCheckbox.checked) {
                // Otomatis mengisi nokondektur jika kotak centang dicentang
                const yearMonth = new Date().getFullYear() + ('0' + (new Date().getMonth() + 1)).slice(-2);
                const autoGeneratedValue = 'K-' + yearMonth + 'xxx'; // Ganti dengan nilai yang sesuai
                nokondekturInput.value = autoGeneratedValue;
            } else {
                // Kosongkan input jika kotak centang tidak dicentang
                nokondekturInput.value = '';
            }
        });

        // Event handler saat NIK diubah
        nikInput.addEventListener('input', function () {
            // Cek apakah NIK ada dalam sistem (gantilah dengan logika yang sesuai)
            const nikExistsInSystem = checkIfNIKExists(nikInput.value);

            // Tampilkan pesan notifikasi jika NIK tidak ditemukan
            if (!nikExistsInSystem) {
                nikNotFoundMessage.classList.remove('hidden');
            } else {
                nikNotFoundMessage.classList.add('hidden');
            }
        });

        // Fungsi untuk memeriksa apakah NIK ada dalam sistem
        function checkIfNIKExists(nik) {
            // Implementasikan logika untuk memeriksa NIK dalam sistem Anda di sini
            // Anda dapat membuat permintaan AJAX atau menghubungkan ke basis data
            // Contoh sederhana: cek jika NIK adalah '12345'
            return nik === '12345';
        }

      </script>


</x-app-layout>
