<x-app-layout>

    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('kotas.index') }}" class="font-medium text-base mr-auto">
                    Kota Tujuan
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <form action="{{ route('kotas.store') }}" method="POST">
                            @csrf
                            <div>
                                <label class="form-label">Kota Tujuan</label>
                                <input id="kota" type="text" name="kota" value="{{ old('kota') }}" class="form-control" placeholder="Input kota" minlength="3" required>

                                @error('kota')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
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
