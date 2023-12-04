<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('karyawans.index') }}" class="intro-y text-lg font-medium mr-auto">
                Karyawan
            </a>
        </div>

        <div class="intro-y box py-10 sm:py-20 mt-3">
            <div class="px-5 sm:px-10">
                <form action="{{ route('karyawans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-2">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="off" required>
                            <div id="nik-suggestion-list"></div>
                            @error('nik')
                            <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Induk</label>
                            <input id="nokaryawan" name="nokaryawan" type="text" value="{{ old('nokaryawan') }}" class="form-control" required>
                            @error('nokaryawan')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jabatan</label>
                            <select id="jabatan_id" name="jabatan_id" data-search="true" class="tom-select w-full">
                                <option value="{{ old('jabatan_id') }}">Select Jabatan</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">User ID</label>
                            <select id="user_id" name="user_id" data-search="true" class="tom-select w-full">
                                <option value="{{ old('user_id') }}">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal KP</label>
                            <input id="tgl_kp" type="date" name="tgl_kp" value="{{ old('tgl_kp') }}" class="form-control @error('nobody') is-invalid @enderror" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Masuk</label>
                            <input id="tgl_masuk" name="tgl_masuk" type="date" value="{{ old('tgl_masuk') }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pendidikan</label>
                            <select id="pendidikan" name="pendidikan" data-search="true" class="tom-select" required>
                                <option value="">Select Status</option>
                                <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="Diploma" {{ old('pendidikan') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="SMK" {{ old('pendidikan') == 'SMK' ? 'selected' : '' }}>SMK</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Golongan Darah</label>
                            <input id="gol_darah" name="gol_darah" type="text" value="{{ old('gol_darah') }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tinggi Badan</label>
                            <input id="tinggi" name="tinggi" type="text" value="{{ old('tinggi') }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Jamsostek</label>
                            <input id="nojamsostek" name="nojamsostek" type="text" value="{{ old('nojamsostek') }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Jamsostek</label>
                            <input id="tgl_jamsos" name="tgl_jamsos" type="date" value="{{ old('tgl_jamsos') }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Password</label>
                            <input id="password" name="password" type="text" value="{{ old('password') }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Disable" {{ old('status') == 'Disable' ? 'selected' : '' }}>Disable</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan" name="keterangan" type="text" value="{{ old('keterangan') }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    @push('scripts')
        <script>
           $(document).ready(function() {
                $('#nik').select2({
                    placeholder: 'Select NIK',
                    ajax: {
                        url: '/search-nik', // Ganti dengan URL endpoint Anda
                        type: 'GET',
                        delay: 250,
                        processResults: function(response) {
                            return {
                                results: response.data
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>
    @endpush
    <script>
        $(document).ready(function() {
            $('#nik').on('input', function() {
                var query = $(this).val();
                if (query.length >= 1) {
                    $.ajax({
                        url: '/search-nik', // Ganti dengan URL endpoint Anda
                        type: 'GET',
                        data: { 'query': query }, // Tambahkan tanda kutip ganda pada properti 'query'
                        success: function(response) {
                            var suggestions = response.data;
                            var suggestionList = $('#nik-suggestion-list');
                            suggestionList.empty();
                            if (suggestions.length > 0) {
                                for (var i = 0; i < suggestions.length && i < 10; i++) {
                                    suggestionList.append('<div>' + suggestions[i].nik + ' - ' + suggestions[i].nama + '</div>');
                                }
                            } else {
                                suggestionList.append('<div>No suggestions found.</div>');
                            }
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
