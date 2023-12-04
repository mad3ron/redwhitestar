<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('pengemudi.index') }}" class="intro-y text-lg font-medium mr-auto">
                Create Pengemudi
            </a>
        </div>
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="intro-y box py-10 sm:py-10 mt-5">
            <div class="px-5 sm:px-10 ">
                <form action="{{ route('pengemudi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="new-password" required>
                            <div id="nik-suggestion-list"></div>
                            @error('nik')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">No. Pengemudi</label>
                            <input type="text" id="nopengemudi" name="nopengemudi" class="form-control" value="{{ old('nopengemudi') }}">

                            @error('nopengemudi')
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
                            <input type="date" id="tgl_kp" name="tgl_kp" class="form-control" value="{{ old('tgl_kp') }}">
                            @error('tgl_kp')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input field untuk nosim, jenis_sim, dan tgl_sim -->
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">No.SIM</label>
                            <input type="text" id="nosim" name="nosim" class="form-control" value="{{ old('nosim') }}">

                            @error('nosim')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jenis SIM</label>
                            <select id="jenis_sim" name="jenis_sim" data-search="true" class="tom-select w-full">
                                @foreach (App\Enums\TableSim::cases() as $status)
                                    <option value="{{ $status->value }}" {{ $status->value == old('jenis_sim') ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_sim')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal SIM</label>
                            <input type="date" id="tgl_sim" name="tgl_sim" class="form-control" value="{{ old('tgl_sim') }}">

                            @error('tgl_sim')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input field untuk nojamsostek, tgl_jamsos, dan status -->
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Jamsostek</label>
                            <input type="text" id="nojamsostek" name="nojamsostek" class="form-control" value="{{ old('nojamsostek') }}">

                            @error('nojamsostek')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Jamsostek</label>
                            <input type="date" id="tgl_jamsos" name="tgl_jamsos" class="form-control" value="{{ old('tgl_jamsos') }}">

                            @error('tgl_jamsos')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
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
                            <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <!---Button-->
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <button type="submit" class="btn btn-primary w-24 mr-1 mb-2">Save</button>
                            <a href="{{ route('pengemudi.index') }}" class="btn btn-pending w-24 mr-1 mb-2">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    {{-- @push('scripts')
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
    @endpush
    <style>
        .button-group {
            display: flex;
            justify-content: flex-start;
            gap: 10px; /* Jarak antara tombol */
        }
    </style> --}}
</x-app-layout>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
