<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('poscheckers.index') }}" class="font-medium text-base mr-auto">
                    Edit Pos Checker
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form method="POST" action="{{ route('poscheckers.update', $poschecker->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <div class="grid grid-cols-12 gap-4 gap-y-5">
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label class="form-label">Kode Pos</label>
                                    <input id="kodepos" name="kodepos" type="text" value="{{ $poschecker->kodepos }}" class="form-control">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="namapos" class="form-label">Nama Pos</label>
                                    <input id="namapos" type="text" name="namapos" value="{{ $poschecker->namapos }}" class="form-control">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label class="form-label">Wilayah</label>
                                    <select id="wilayah" name="wilayah" data-search="true" class="tom-select" required>
                                        <option value="">Select Status</option>
                                        <option value="Timur" {{ old('wilayah', $poschecker->wilayah) == 'Timur' ? 'selected' : '' }}>Timur</option>
                                        <option value="Barat" {{ old('wilayah', $poschecker->wilayah) == 'Barat' ? 'selected' : '' }}>Barat</option>
                                    </select>
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label class="form-label">Status</label>
                                    <select id="status" name="status" data-search="true" class="tom-select" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" @if(old('status', $poschecker->status) == 'Active') selected @endif>Active</option>
                                        <option value="Inactive" @if(old('status', $poschecker->status) == 'Inactive') selected @endif>Inactive</option>
                                        <option value="Disable" @if(old('status', $poschecker->status) == 'Disable') selected @endif>Disable</option>
                                    </select>
                                </div>
                            </div>
                            <!---Button-->
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
