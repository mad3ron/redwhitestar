<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('posisis.index') }}" class="font-medium text-base mr-auto">
                    Data Pos Checker
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10">
                    <form action="{{ route('posisis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="grid grid-cols-12 gap-4 gap-y-5">
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label class="form-label">Posisi</label>
                                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Input Posisi" value="{{ old('name') }}" required>

                                    @error('name')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="kodeposisi" class="form-label">Kode Posisi</label>
                                    <input id="kodeposisi" type="text" name="kodeposisi" class="form-control" placeholder="Input Nama Pos" value="{{ old('kodeposisi') }}" minlength="2" required>
                                    @error('kodeposisi')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!---Button-->
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
