<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('karyawans.index') }}" class="intro-y text-lg font-medium mr-auto">
                Edit Karyawan
            </a>
        </div>

        <div class="intro-y box py-10 sm:py-20 mt-3">
            <div class="px-5 sm:px-10">
                <form method="POST" action="{{ route('karyawans.update', $karyawan->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-4 gap-y-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Induk</label>
                            <input id="nokaryawan" name="nokaryawan" type="text" value="{{ $karyawan->nokaryawan }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">NIK KTP dan Nama</label>
                            <input id="nik" name="nik" type="text" class="form-control" autocomplete="off" value="{{ $karyawan->nik }}" required>
                            <div id="nik-suggestion-list"></div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jabatan</label>
                            <select id="jabatan_id" name="jabatan_id" data-search="true" class="tom-select w-full">
                                <option value="">Select Jabatan</option>
                                @foreach ($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" @if ($jabatan->id == $karyawan->jabatan_id) selected @endif>{{ $jabatan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">User ID</label>
                            <select id="user_id" name="user_id" data-search="true" class="tom-select w-full">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id == $karyawan->user_id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal KP</label>
                            <input id="tgl_kp" type="date" name="tgl_kp" value="{{ $karyawan->tgl_kp }}" class="form-control @error('nobody') is-invalid @enderror" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Masuk</label>
                            <input id="tgl_masuk" name="tgl_masuk" type="date" value="{{ $karyawan->tgl_masuk }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pendidikan</label>
                            <select id="pendidikan" name="pendidikan" data-search="true" class="tom-select" required>
                                <option value="">Select Status</option>
                                <option value="S1" @if ($karyawan->pendidikan == 'S1') selected @endif>S1</option>
                                <option value="Diploma" @if ($karyawan->pendidikan == 'Diploma') selected @endif>Diploma</option>
                                <option value="SMA" @if ($karyawan->pendidikan == 'SMA') selected @endif>SMA</option>
                                <option value="SMK" @if ($karyawan->pendidikan == 'SMK') selected @endif>SMK</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Golongan Darah</label>
                            <input id="gol_darah" name="gol_darah" type="text" value="{{ $karyawan->gol_darah }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tinggi Badan</label>
                            <input id="tinggi" name="tinggi" type="text" value="{{ $karyawan->tinggi }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Jamsostek</label>
                            <input id="nojamsostek" name="nojamsostek" type="text" value="{{ $karyawan->nojamsostek }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Jamsostek</label>
                            <input id="tgl_jamsos" name="tgl_jamsos" type="date" value="{{ $karyawan->tgl_jamsos }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Password</label>
                            <input id="password" name="password" type="text" value="{{ $karyawan->password }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="Active" {{ $karyawan->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $karyawan->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Disable" {{ $karyawan->status == 'Disable' ? 'selected' : '' }}>Disable</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan" name="keterangan" type="text" value="{{ $karyawan->keterangan }}" class="form-control">
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
