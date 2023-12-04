<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('pengemudi.index') }}" class="intro-y text-lg font-medium mr-auto">
                Edit pengemudi
            </a>
        </div>
        <div class="intro-y box py-10 sm:py-10 mt-5">
            <div class="px-5 sm:px-10">
                <form method="POST" action="{{ route('pengemudi.update', $pengemudi->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-4 gap-y-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Induk</label>
                            <input id="nopengemudi" name="nopengemudi" type="text" value="{{ $pengemudi->nopengemudi }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">NIK KTP dan Nama</label>
                            <input id="nik" name="nik" type="text" class="form-control" autocomplete="off" value="{{ $pengemudi->nik }}" required>
                            <div id="nik-suggestion-list"></div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Rute</label>
                            <select id="rute_id" name="rute_id" class="tom-select w-full" required>
                                <option value="">{{ __('Select Rute') }}</option>
                                @if (count($rutes) > 0)
                                    @foreach ($rutes as $rute)
                                        <option value="{{ $rute->id }}" {{ $rute->id == ($pengemudi->rute_id ?? '') ? 'selected' : '' }}>
                                            {{ $rute->koderute }} - {{ $rute->namarute }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal KP</label>
                            <input id="tgl_kp" name="tgl_kp" type="date" value="{{ $pengemudi->tgl_kp }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor SIM</label>
                            <input id="nosim" name="nosim" type="text" value="{{ $pengemudi->nosim }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jenis SIM</label>
                            <select id="jenis_sim" name="jenis_sim" data-search="true" class="tom-select w-full">
                                @foreach (App\Enums\TableSim::cases() as $status)
                                    <option value="{{ $status->value }}" {{ $status->value == $pengemudi->jenis_sim ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal SIM</label>
                            <input id="tgl_sim" name="tgl_sim" type="date" value="{{ $pengemudi->tgl_sim }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">No. Jamsostek</label>
                            <input id="nojamsostek" name="nojamsostek" type="text" value="{{ $pengemudi->nojamsostek }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Tanggal Jamsos</label>
                            <input id="tgl_jamsos" name="tgl_jamsos" type="date" value="{{ $pengemudi->tgl_jamsos }}" class="form-control">
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="AKTIF" {{ $pengemudi->status == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                                <option value="BERMASALAH" {{ $pengemudi->status == 'BERMASALAH' ? 'selected' : '' }}>BERMASALAH</option>
                                <option value="NONAKTIF" {{ $pengemudi->status == 'NONAKTIF' ? 'selected' : '' }}>NONAKTIF</option>
                                <option value="KELUAR" {{ $pengemudi->status == 'KELUAR' ? 'selected' : '' }}>KELUAR</option>
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan" name="keterangan" type="text" value="{{ $pengemudi->keterangan }}" class="form-control">
                        </div>

                        <!-- Button -->
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
                            <a href="{{ route('pengemudi.index') }}" class="btn btn-pending w-24 mr-1 mb-2">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
