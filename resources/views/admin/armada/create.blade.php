<x-app-layout>
    <div class="mt-10">
            <a href="{{ route('armada.index') }}" class="intro-y text-lg font-medium mr-auto">
                Create Jenis Armada
            </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('armada.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jenis Armada</label>
                                <input id="jenis_armada" type="text" name="jenis_armada" class="form-control @error('jenis_armada') text-red-700 @enderror" placeholder="Input Jenis Armada" minlength="3" required>

                                @error('jenis_armada')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Seat</label>
                                <input id="seat" type="text" name="seat" class="form-control @error('seat') text-red-700 @enderror" placeholder="Input Seat" minlength="1" required>

                                @error('seat')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Descripsi</label>
                                <textarea id="descripsi" name="descripsi" class="form-control @error('descripsi') text-red-700 @enderror" placeholder="Input descripsi" rows="4"></textarea>

                                @error('descripsi')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Photo</label>
                                <input id="photo" type="file" name="photo" class="form-control @error('photo') text-red-700 @enderror" placeholder="Input photo">

                                @error('photo')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div class="mt-5 sm:mt-10">
                                    <button id="armada-submit" type="submit" class="btn btn-primary mr-2">Simpan</button>
                                    <a href="{{ route('armada.index') }}" class="btn btn-outline-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
