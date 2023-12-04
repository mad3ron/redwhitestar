<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('booking.index') }}" class="intro-y text-lg font-medium mr-auto">
            Create booking
        </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Nomor booking</label>
                                <input type="text" name="nobooking" id="nobooking" class="form-control" value="{{ $nomorBooking }}" readonly>
                                @error('nobooking')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Nomor Body</label>
                                <input type="text" name="bis_id" id="nobooking" class="form-control" value="{{ $nobody }}" readonly>

                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control col-span-3" data-single-mode="true">
                                    @error('tanggal')
                                        <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="nama_konsumen" class="form-label">Nama Konsumen</label>
                                <input id="nama_konsumen" type="text" name="nama_konsumen" value="{{ old('nama_konsumen') }}" class="form-control @error('nama_konsumen') text-red-700 @enderror" placeholder="Input Nama Konsumen" required>
                                    @error('nama_konsumen')
                                        <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <select id="tujuan_id" name="tujuan_id" class="tom-select select2" data-tags="true" required>
                                    <option value="">{{ __('Select Tujuan') }}</option>
                                    @if(isset($tujuans) && count($tujuans) > 0)
                                        @foreach($tujuans as $tujuan)
                                            <option value="{{ $tujuan->id }}" {{ old('tujuan_id') == $tujuan->id ? 'selected' : '' }}>
                                                {{ $tujuan->tujuan }} - {{ $tujuan->harga_dasar }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('tujuan_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Phone</label>
                                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') text-red-700 @enderror" placeholder="Input phone" minlength="2" required>
                                @error('phone')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label class="form-label">Keterangan</label>
                                <input id="keterangan" type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') text-red-700 @enderror" placeholder="Input Keterangan">
                                @error('keterangan')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                              <!-- User ID (Tersembunyi) -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="intro-y col-span-12 sm:col-span-12">
                                <button id="booking-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route('booking.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('input[name="bis_id"]').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '/api/bis',
                        type: 'GET',
                        data: {
                            search: request.term,
                        },
                        success: function(data) {
                            response(data.data);
                        },
                    });
                },
            });
        });
    </script>

</x-app-layout>
