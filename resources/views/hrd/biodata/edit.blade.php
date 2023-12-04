<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('biodatas.index') }}" class="intro-y text-lg font-medium mr-auto">
                Edit Biodata Pengguna
            </a>
        </div>
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-10 sm:py-10 mt-5">
            <div class="px-5 sm:px-10 ">
                <form method="POST" action="{{ route('biodatas.update', $biodata->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12<div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor KTP</label>
                            <input id="nik" name="nik" type="text" value="{{ $biodata->nik }}" class="form-control" minlength="16" required @error('nik') is-invalid @enderror>

                            @error('nik')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor KK</label>
                            <input id="nokk" name="nokk" type="text" value="{{ $biodata->nokk }}" class="form-control" minlength="16" required>
                            @error('nokk')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nama</label>
                            <input id="nama" name="nama" type="text" value="{{ $biodata->nama }}" class="form-control" minlength="3" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Kota Lahir</label>
                            <select id="kotalahir_id" name="kotalahir_id" class="tom-select" required>
                                <option value="">{{ __('Select Tempat Lahir') }}</option>
                                @if (count($kotalahirs) > 0)
                                    @foreach ($kotalahirs as $kotalahir)
                                        <option value="{{ $kotalahir->id }}" {{ $biodata->kotalahir_id == $kotalahir->id ? 'selected' : '' }}>
                                            {{ $kotalahir->tempat_lahir }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>{{ __('No Tempat Lahir available') }}</option>
                                @endif
                            </select>
                            @error('kotalahir_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input id="tgl_lahir" name="tgl_lahir" type="date" value="{{ old('tgl_lahir', $biodata->tgl_lahir) }}" class="form-control" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="">Select Status</option>
                                    <option value="Nikah" {{ $biodata->status == 'Nikah' ? 'selected' : '' }}>Nikah</option>
                                    <option value="Lajang" {{ $biodata->status == 'Lajang' ? 'selected' : '' }}>Lajang</option>
                                    <option value="Duda" {{ $biodata->status == 'Duda' ? 'selected' : '' }}>Duda</option>
                                    <option value="Janda" {{ $biodata->status == 'Janda' ? 'selected' : '' }}>Janda</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Agama</label>
                            <select id="agama" name="agama" data-search="true" class="tom-select" required>
                                <option value="">Select Jenis</option>
                                    <option value="Islam" {{ $biodata->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ $biodata->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jenis</label>
                            <select id="jenis" name="jenis" data-search="true" class="tom-select" required>
                                <option value="">Select Jenis</option>
                                    <option value="Laki-laki" {{ $biodata->jenis == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $biodata->jenis == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Alamat</label>
                            <input id="alamat" name="alamat" type="text" value="{{$biodata->alamat }}" class="form-control" minlength="3" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">RT</label>
                            <input id="rt" name="rt" type="number" value="{{ $biodata->rt }}" class="form-control" minlength="1" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">RW</label>
                            <input id="rw" name="rw" type="number" value="{{ $biodata->rw }}" class="form-control" minlength="1" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Kelurahan</label>
                            <select id="kelurahan_id" name="kelurahan_id" class="tom-select" data-tags="true" required>
                                <option value="">{{ __('Select Kelurahan') }}</option>
                                @if (count($kelurahans) > 0)
                                    @foreach ($kelurahans as $kelurahan)
                                        <option value="{{ $kelurahan->id }}" {{ $biodata->kelurahan_id == $kelurahan->id ? 'selected' : '' }}>
                                            {{ $kelurahan->name }} - {{ $kelurahan->kecamatan }} - {{ $kelurahan->kabkota }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kelurahan_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Phone</label>
                            <input id="phone" name="phone" type="text" value="{{ $biodata->phone }}" class="form-control" minlength="10" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jabatan</label>
                            <select id="jabatan_id" name="jabatan_id" class="tom-select" required>
                                <option value="">{{ __('Select Jabatan') }}</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id }}" {{ $biodata->jabatan_id == $jabatan->id ? 'selected' : '' }}>
                                            {{ $jabatan->name }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('jabatan_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Is visible</label>
                            <select id="is_visible" name="is_visible" data-search="true" class="tom-select" required>
                                <option value="Active" {{$biodata->is_visible == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $biodata->is_visible == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Disable" {{ $biodata->is_visible == 'Disable' ? 'selected' : '' }}>Disable</option>
                            </select>
                        </div>

                    </div>
                        <!---Button-->
                        <div class="mt-5 sm:mt-10">
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a href="{{ route('biodatas.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- END: Wizard Layout -->
    </div>
</x-app-layout>
