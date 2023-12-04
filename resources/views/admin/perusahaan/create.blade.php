<x-app-layout>

    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
    {{-- @if ($errors->any())
            <div class="alert alert-primary-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('perusahaans.index') }}" class="font-medium text-base mr-auto">
                    Input Perusahaan
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                            <form action="{{ route('perusahaans.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div>
                                <label class="form-label">Nama Perusahaan</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control @error('name')@enderror"  placeholder="Input name" minlength="3" required>

                                @error('name')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">Data sudah ada</div>
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
