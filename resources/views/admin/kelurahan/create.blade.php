<x-app-layout>

    {{-- <div class="col-span-12 lg:col-span-8 2xl:col-span-9"> --}}
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('kelurahans.index') }}" class="font-medium text-base mr-auto">
                    Personal Information
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                            <form action="{{ route('kelurahans.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div>
                                <label class="form-label">Kelurahan/Desa</label>
                                <input id="name" type="text" name="name" class="form-control @error('name') text-red-700 @enderror" placeholder="Input name" minlength="3" required>

                                @error('name')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Kecamatan</label>
                                <input id="kecamatan" type="text" name="kecamatan" class="form-control @error('kecamatan') text-red-700 @enderror" placeholder="Input kecamatan" minlength="3" required>

                                @error('kecamatan')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Dapil</label>
                                <input id="dapil" type="text" name="dapil" class="form-control @error('dapil') text-red-700 @enderror" placeholder="Input Dapil" minlength="3" required>

                                @error('dapil')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Kabupaten/Kota</label>
                                <input id="kabkota" type="text" name="kabkota" class="form-control @error('name') text-red-700 @enderror" placeholder="Input Kabupaten/Kota" minlength="3" required>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Provinsi</label>
                                <input id="provinsi" type="text" name="provinsi" class="form-control @error('provinsi') text-red-700 @enderror" placeholder="Input provinsi" minlength="3" required>

                                @error('provinsi')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Kode Pos</label>
                                <input id="kodepos" type="text" name="kodepos" class="form-control @error('kodepos') text-red-700 @enderror" placeholder="Input Kodepos" minlength="3" required>

                                @error('kodepos')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <div class="flex justify-end mt-4">
                                    <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
</x-app-layout>
