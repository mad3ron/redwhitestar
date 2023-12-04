<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('pool.index') }}" class="font-medium text-base mr-auto">
                    Edit Pool
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <form method="POST" action="{{ route('pool.update', $pool->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label">Pool</label>
                                <input id="nama_pool" name="nama_pool" type="text" value="{{ $pool->nama_pool }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ $pool->alamat }}</textarea>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Phone</label>
                                <input id="phone" name="phone" type="text" value="{{ $pool->phone }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" class="tom-select w-full">
                                    @foreach (App\Enums\TableActive::cases() as $status)
                                        <option value="{{ $status->value }}" {{ $status->value === $pool->status ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!---Button-->
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
