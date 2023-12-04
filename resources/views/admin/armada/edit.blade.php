<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('armada.index') }}" class="intro-y text-lg font-medium mr-auto">
            Edit armada
        </a>
        <div class="p-5">
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form method="POST" action="{{ route('armada.update', $armada->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Jenis Armada</label>
                                <input type="text" name="jenis_armada" id="jenis_armada" class="form-control @error('jenis_armada') is-invalid @enderror" value="{{ $armada->jenis_armada }}">
                                @error('jenis_armada')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Seat</label>
                                <input type="text" name="seat" id="seat" class="form-control @error('seat') is-invalid @enderror" value="{{ $armada->seat }}">
                                @error('seat')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Descripsi</label>
                                <textarea id="descripsi" name="descripsi" class="form-control @error('descripsi') text-red-700 @enderror">{{ $armada->descripsi }}</textarea>

                                @error('descripsi')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Photo</label>
                                <input id="photo" type="file" name="photo" value="{{ $armada->foto }}" class="form-control @error('photo') text-red-700 @enderror" placeholder="Input foto">
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <div class="flex justify-end mt-4">
                                    <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
