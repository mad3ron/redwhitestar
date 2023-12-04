<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('spj-keluar.index') }}" class="text-lg font-medium mr-auto">
            Daftar SPJ Keluar
        </a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('spj-keluar.create') }}" class="btn btn-primary shadow-md mr-2">Tambah</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            {{-- <a href="{{ route('bis.view-pdf', [
                                'start_date' => Request::get('start_date'),
                                'end_date' => Request::get('end_date')
                                ]) }}" class="dropdown-item">
                                <i data-lucide="file-text" target="_blank" class="w-4 h-4 mr-2"></i>Export PDF
                            </a> --}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500">
                Showing {{ $spjkeluar->firstItem() }} to {{ $spjkeluar->lastItem() }} of {{ $spjkeluar->total() }} entries
            </div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <form method="GET" action="{{ route('spj-keluar.index') }}">
                    @csrf
                    <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search..." value="{{ Request::get('search') }}">
                </form>
                <form method="GET" action="{{ route('spj-keluar.index') }}">
                    <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                    {{-- <input type="date" name="tanggal" id="tanggal" class="datepicker form-control w-40 box pr-10" data-single-mode="true"
                    value="{{ date('Y-m-d') }}"> --}}
                    <button type="submit" class="btn btn-primary shadow-md mr-2"> <i data-lucide="Search" class="w-4 h-4 mr-2"></i> Search</button>
                </form>
            </div>
        </div>
         <!-- BEGIN: Data List -->
         <div class="intro-y col-span-12 overflow-auto">
            <table class="table table-report -mt-2">
                <table class="table table-report">
                    <thead>
                        <tr>
                            <th class="uppercase text-xs whitespace-nowrap">No.</th>
                            <th class="uppercase text-xs whitespace-nowrap">Nomor SPJ</th>
                            <th class="uppercase text-xs">Tanggal Keluar</th>
                            <th class="uppercase text-xs">Posisi Bis</th>
                            <th class="uppercase text-xs">No.Body No.Polisi</th>
                            <th class="uppercase text-xs">Rute</th>
                            <th class="uppercase text-xs whitespace-nowrap">Pengemudi</th>
                            <th class="uppercase text-xs whitespace-nowrap">Kondektur</th>
                            <th class="uppercase text-xs">Nama Pemesan</th>
                            <th class="uppercase text-xs">Tujauan</th>
                            <th class="uppercase text-xs">Jml Bis</th>
                            <th class="uppercase text-xs">Alamat.Jemput</th>
                            <th class="uppercase text-xs">Jam.Jemput</th>
                            <th class="uppercase text-xs whitespace-nowrap">KM Keluar</th>
                            <th class="uppercase text-xs whitespace-nowrap">Uang Jalan</th>
                            <th class="uppercase text-xs whitespace-nowrap">Keterangan</th>
                            <th class="uppercase text-xs whitespace-nowrap">User</th>
                            <th class="uppercase text-xs whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spjkeluar as $data)
                        @if ($data->posisis->name !== 'Bis Setor')
                            <tr class="intro-x">
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $spjkeluar->firstItem() + $loop->index }}</td>
                                {{-- <td class="w-20">
                                    <a href="{{ route('spj-keluar.show', ['nomorspj' => $data->id]) }}"
                                        class="uppercase text-xs whitespace-nowrap mt-0.5"><b>{{  $data->nomorspj }}</b>
                                    </a>
                                </td> --}}
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nomorspj }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_klr }}</td>
                                <td class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">{{ $data->posisis->name }}</td>
                                <td class="w-20">
                                    <a href="#" class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->bis->nobody }}</a>
                                    <div class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nopolisi }}</div>
                                </td>
                                <td class="w-20">
                                    <span class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->rutes->koderute }}</span>
                                    <div class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">{{ $data->pools->nama_pool }}</div>
                                </td>
                                <td class="w-20">
                                    <a href="#" class="uppercase text-xs whitespace-nowrap mt-0.5"> {{ $data->pengemudis->nopengemudi }}</a>
                                    <div class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">
                                        {{ $data->pengemudis->biodata->nama }}
                                    </div>
                                </td>
                                <td class="w-20">
                                    <a href="#" class="uppercase text-xs whitespace-nowrap mt-0.5"> {{ $data->kondekturs->nokondektur }}</a>
                                    <div class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5"> {{ $data->kondekturs->biodata->nama }}</div>
                                </td>
                                <td class="w-20">
                                    <a href="#" class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->pemesanans->nama_pemesan }}</a>
                                    <div class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">{{ $data->pemesanans->phone }}</div>
                                </td>
                                <td class="w-20">
                                    <a href="#" class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->pemesanans->tujuans->tujuan }}</a>
                                </td>
                                <td class="uppercase text-xs font-medium whitespace-nowrap">{{ $data->pemesanans->jml_bis }}</td>
                                <td class="uppercase text-xs font-medium whitespace-nowrap">{{ $data->pemesanans->alamat }}</td>
                                <td class="uppercase text-xs font-medium whitespace-nowrap">{{ $data->pemesanans->jam_jemput }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->kmkeluar }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->uang_jalan }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->keterangan_spjklr }}</td>
                                <td class="uppercase text-xs whitespace-nowrap">{{ $data->user->name }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('spj-keluar.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        <form
                                            class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('spj-keluar.destroy', $data->id) }}"
                                            onsubmit="return confirm('Are you sure?');"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                    {{ $spjkeluar->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
