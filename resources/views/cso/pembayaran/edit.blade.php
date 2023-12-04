<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('pembayaran.index') }}" class="intro-y text-lg font-medium mr-auto">
            Update Pembayaran
        </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form method="POST" action="{{ route('pembayaran.update', $pembayaran->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Nomor Pembayaran</label>
                                <input type="text" name="nomorPembayaran" id="nomorPembayaran" class="form-control" value="{{ $nomorPembayaran }}" readonly>
                                @error('nomorPembayaran')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Pemesan</label>
                                <select id="nopesan_id" name="nopesan_id" class="tom-select" data-tags="true" required>
                                    <option value="">{{ __('Select Pemesan') }}</option>
                                    @foreach ($pemesanans as $pemesanan)
                                        <option value="{{ $pemesanan->id }}" {{ old('nopesan_id', $pembayaran->nopesan_id) == $pemesanan->id ? 'selected' : '' }}>
                                            {{ $pemesanan->nama_pemesan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('nopesan_id')
                                    <div class="text-theme-6 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input id="tgl_bayar" type="date" name="tgl_bayar" value="{{  $pembayaran->tgl_bayar, date('Y-m-d') }}" class="form-control @error('tgl_bayar') text-red-700 @enderror" placeholder="Input Tanggal Pembayaran" required>
                                @error('tgl_bayar')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div id="kode_pembayaran" class="input-group-text">Kode Pembayaran</div>
                                <select id="kode_pembayaran" name="kode_pembayaran" data-search="true" class="tom-select w-full" required>
                                    <option value="">Select kode_pembayaran</option>
                                        <option value="Uang Muka" {{  $pembayaran->kode_pembayaran == 'Uang Muka' ? 'selected' : '' }}>Uang Muka</option>
                                        <option value="Uang Muka 2" {{  $pembayaran->kode_pembayaran == 'Uang Muka 2' ? 'selected' : '' }}>Uang Muka 2</option>
                                        <option value="Uang Muka 3" {{  $pembayaran->kode_pembayaran == 'Uang Muka 3' ? 'selected' : '' }}>Uang Muka 3</option>
                                        <option value="Pelunasan" {{  $pembayaran->kode_pembayaran == 'Pelunasan' ? 'selected' : '' }}>Pelunasan</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input id="jml_bayar" type="text" name="jml_bayar" value="{{ $pembayaran->jml_bayar }}" class="form-control @error('jml_bayar') text-red-700 @enderror" placeholder="Input Jumlah Pembayaran"required>
                                @error('jml_bayar')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Discount</label>
                                <input id="discount" type="text" name="discount" value="{{  $pembayaran->discount  }}" class="form-control @error('discount') text-red-700 @enderror" placeholder="Input Discount"required>
                                @error('discount')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div id="jenis_bayar" class="input-group-text">Jenis Pembayaran</div>
                                <select id="jenis_bayar" name="jenis_bayar" data-search="true" class="tom-select w-full" required>
                                    <option value="">Select Jenis Pembayaran</option>
                                        <option value="CASH" {{  $pembayaran->jenis_bayar == 'CASH' ? 'selected' : '' }}>CASH</option>
                                        <option value="TRANSFER" {{  $pembayaran->jenis_bayar == 'TRANSFER' ? 'selected' : '' }}>TRANSFER</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12">
                                <label class="form-label">Keterangan</label>
                                <input id="keterangan" type="text" name="keterangan" class="form-control" value="{{  $pembayaran->keterangan }}">
                            </div>
                              <!-- User ID (Tersembunyi) -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div class="mt-5 sm:mt-10">
                                    <button id="pembayaran-submit" type="submit" class="btn btn-primary mr-2">Update</button>
                                    <a href="{{ route('pembayaran.index') }}" class="btn btn-warning">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
