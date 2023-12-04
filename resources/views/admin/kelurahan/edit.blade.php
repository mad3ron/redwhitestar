<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('kelurahans.index') }}" class="font-medium text-base mr-auto">
                    Edit Kelurahan
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <form method="POST" action="{{ route('kelurahans.update', $kelurahan->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label">Kelurahan</label>
                                <input id="name" name="name" type="text" value="{{ $kelurahan->name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Kecamatan</label>
                                <input id="kecamatan" name="kecamatan" type="kecamatan" value="{{ $kelurahan->kecamatan }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">dapil</label>
                                <input id="dapil" name="dapil" type="text" value="{{ $kelurahan->dapil }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">kabkota</label>
                                <input id="kabkota" name="kabkota" type="text" value="{{ $kelurahan->kabkota }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">provinsi</label>
                                <input id="provinsi" name="provinsi" type="text" value="{{ $kelurahan->provinsi }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">kodepos</label>
                                <input id="kodepos" name="kodepos" type="text" value="{{ $kelurahan->kodepos }}" class="form-control">
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
