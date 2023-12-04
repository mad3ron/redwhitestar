<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('posisis.index') }}" class="font-medium text-base mr-auto">
                    Edit Pos Checker
                </a>
            </div>
            <div class="intro-y box py-10 sm:py-10 mt-5">
                <div class="px-5 sm:px-10 ">
                    <form method="POST" action="{{ route('posisis.update', $posisi->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <div class="grid grid-cols-12 gap-4 gap-y-5">
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label class="form-label">Kode Pos</label>
                                    <input id="name" name="name" type="text" value="{{ $posisi->name }}" class="form-control">
                                </div>
                                <div class="intro-y col-span-12 sm:col-span-6">
                                    <label for="kodeposisi" class="form-label">Nama Pos</label>
                                    <input id="kodeposisi" type="text" name="kodeposisi" value="{{ $posisi->kodeposisi }}" class="form-control">
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
