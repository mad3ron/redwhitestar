<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <a href="{{ route('userapps.index') }}" class="intro-y text-lg font-medium mr-auto">
                User Applikasi
            </a>
        </div>
        <div class="intro-y box py-10 sm:py-10">
            <div class="px-5 sm:px-10">
                <form action="{{ route('userapps.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">User ID</label>
                            <select id="user_id" name="user_id" class="tom-select select2" data-tags="true" required>
                                <option value="">{{ __('Select User') }}</option>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            @error('user_id')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nokar ID</label>
                            <select id="nokar_id" name="nokar_id" class="tom-select select2" data-tags="true" required>
                                <option value="">{{ __('Select Karyawan') }}</option>
                                @if ($karyawans->count() > 0)
                                    @foreach ($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" {{ old('nokar_id') == $karyawan->id ? 'selected' : '' }}>
                                            {{ $karyawan->biodata->nama }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            @error('nokar_id')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Input password">
                            @error('password')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Disable" {{ old('status') == 'Disable' ? 'selected' : '' }}>Disable</option>
                            </select>
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
