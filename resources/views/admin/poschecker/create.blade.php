<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('poscheckers.index') }}" class="font-medium text-base mr-auto">
                    Data Pos Checker
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form action="{{ route('poscheckers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div>
                        <div class="grid grid-cols-12 gap-4 gap-y-5">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Kode Pos</label>
                                <input id="kodepos" type="text" name="kodepos" class="form-control @error('kodepos') is-invalid @enderror" placeholder="Input Kode Pos"  value="{{ old('kodepos') }}" minlength="2" required>

                                @error('kodepos')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label for="namapos" class="form-label">Nama Pos</label>
                                <input id="namapos" type="text" name="namapos" class="form-control" placeholder="Input Nama Pos" value="{{ old('namapos') }}" minlength="3" required>
                                @error('namapos')
                                    <span class="text-red-400 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Wilayah</label>
                                <select id="wilayah" name="wilayah" data-search="true" class="tom-select" required>
                                    <option value="">Select Status</option>
                                    <option value="Timur" @if(old('wilayah') == 'Timur') selected @endif>Timur</option>
                                    <option value="Barat" @if(old('wilayah') == 'Barat') selected @endif>Barat</option>
                                </select>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" data-search="true" class="tom-select" required>
                                    <option value="">Select Status</option>
                                    <option value="Active" @if(old('status') == 'Active') selected @endif>Active</option>
                                    <option value="Inactive" @if(old('status') == 'Inactive') selected @endif>Inactive</option>
                                    <option value="Disable" @if(old('status') == 'Disable') selected @endif>Disable</option>
                                </select>
                            </div>
                        </div>
                        <!---Button-->
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
