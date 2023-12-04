<x-app-layout>
    <div class="mt-10">
            <a href="{{ route('tujuan.index') }}" class="intro-y text-lg font-medium mr-auto">
                Create Tujuan
            </a>

        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('tujuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
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
                                <label class="form-label">Tujuan</label>
                                <input id="tujuan" type="text" name="tujuan" class="form-control @error('tujuan') text-red-700 @enderror" placeholder="Input Tujuan" minlength="3" required>

                                @error('tujuan')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Pemakaian</label>
                                <input id="pemakaian" type="text" name="pemakaian" class="form-control @error('pemakaian') text-red-700 @enderror" placeholder="Input pemakaian" minlength="2" required>

                                @error('pemakaian')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Harga Dasar</label>
                                <input id="harga_dasar" type="number" name="harga_dasar" class="form-control @error('harga_dasar') text-red-700 @enderror" placeholder="Input harga_dasar" minlength="2" required>

                                @error('harga_dasar')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div class="mt-5 sm:mt-10">
                                    <button id="tujuan-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                    <a href="{{ route('tujuan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
