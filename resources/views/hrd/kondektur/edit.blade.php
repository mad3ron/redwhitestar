<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('kondektur.index') }}" class="intro-y text-lg font-medium mr-auto">
                Edit kondektur
            </a>
        </div>
        <div class="intro-y box py-10 sm:py-10 mt-5">
            <div class="px-5 sm:px-10 ">
                <form method="POST" action="{{ route('kondektur.update', $kondektur->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="grid grid-cols-12 gap-4 gap-y-5">
                    {{-- <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">Nomor NIK</label>
                        <select id="biodata_id" name="biodata_id" data-search="true" class="tom-select w-full">
                            @foreach ($biodatas as $biodata)
                                <option value="{{ $biodata->id }}" @selected($biodata->id == $kondektur->biodata_id)>{{ $biodata->nik }} - {{ $biodata->nama }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">NIK KTP dan Nama</label>
                        <input id="nik" name="nik" type="text" class="form-control" autocomplete="off" value="{{ $kondektur->nik }}" required>
                        <div id="nik-suggestion-list"></div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">Nomor Induk</label>
                        <input id="nokondektur" name="nokondektur" type="text" value="{{ $kondektur->nokondektur }}" class="form-control">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">Rute</label>
                        <select id="rute_id" name="rute_id" class="tom-select w-full" required>
                            <option value="">{{ __('Select Rute') }}</option>
                            @if (count($rutes) > 0)
                                @foreach ($rutes as $rute)
                                    <option value="{{ $rute->id }}" {{ $rute->id == ($kondektur->rute_id ?? '') ? 'selected' : '' }}>
                                        {{ $rute->koderute }} - {{ $rute->namarute }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">Tanggal KP</label>
                        <input id="tgl_kp" name="tgl_kp" type="date" value="{{ $kondektur->tgl_kp }}" class="form-control">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">No. Jamsostek</label>
                        <input id="nojamsostek" name="nojamsostek" type="text" value="{{ $kondektur->nojamsostek }}" class="form-control">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">Tanggal Jamsos</label>
                        <input id="tgl_jamsos" name="tgl_jamsos" type="date" value="{{ $kondektur->tgl_jamsos }}" class="form-control">
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                        <label class="form-label">Status</label>
                        <select id="status" name="status" data-search="true" class="tom-select" required>
                            <option value="">{{ __('Select Status') }}</option>
                            <option value="AKTIF" {{ $kondektur->status == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                            <option value="BERMASALAH" {{ $kondektur->status == 'BERMASALAH' ? 'selected' : '' }}>BERMASALAH</option>
                            <option value="NONAKTIF" {{ $kondektur->status == 'NONAKTIF' ? 'selected' : '' }}>NONAKTIF</option>
                            <option value="KELUAR" {{ $kondektur->status == 'KELUAR' ? 'selected' : '' }}>KELUAR</option>
                        </select>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-12">
                        <label class="form-label">Keterangan</label>
                        <input id="keterangan" name="keterangan" type="text" value="{{ $kondektur->keterangan }}" class="form-control">
                    </div>
                    <!-- Buttom -->
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
                    </div>
                </div>
                </div>

            </form>
            </div>
        </div>
    </div>
</x-app-layout>
