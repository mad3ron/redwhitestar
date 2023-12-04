<x-app-layout>

    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('pool.index') }}" class="font-medium text-base mr-auto">
                    Input Pool
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                            <form action="{{ route('pool.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div>
                                <label class="form-label">Pool</label>
                                <input id="nama_pool" type="text" name="nama_pool" class="form-control" placeholder="Input Nama Pool" required>

                                @error('nama_pool')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Alamat</label>
                                <input id="alamat" type="text" name="alamat" class="form-control" placeholder="Input alamat" minlength="3" required>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Phone</label>
                                <input id="phone" type="text" name="phone" class="form-control" placeholder="Input Phone" minlength="3" required>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" data-search="true" class="tom-select w-full">
                                    <option value="">Select Status</option>
                                        @foreach (App\Enums\TableActive::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                                        @endforeach
                                </select>
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
