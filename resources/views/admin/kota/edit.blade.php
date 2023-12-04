<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">

        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('kotas.index') }}" class="font-medium text-base mr-auto">
                    Edit kota
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <form method="POST" action="{{ route('kotas.update', $kota->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label">kota</label>
                                <input id="kota" type="text" name="kota" value="{{ $kota->kota }}" class="form-control">
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
</x-app-layout>
