<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-6 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-lucide="bus" class="report-box__icon text-primary"></i>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6"> Bis Yang Ada : {{ $totalBisTersedia }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="box p-5">
        <div class="flex">
            <i data-lucide="bus" class="report-box__icon text-primary"></i>
        </div>
        <div class="text-3xl font-medium leading-8 mt-6">
            Posisi Bus:
            @foreach($totals as $total)
                @if($total['total'] > 0)
                    <div>{{ $total['posisi'] }}: {{ $total['total'] }} bis</div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="mt-10">
        <a href="{{ route('jadwal.index') }}" class="text-lg font-medium mr-auto">
            JADWAL PEMESANAN BIS
        </a>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary shadow-md mr-2">Tambah</a>
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
                Showing {{ $jadwals->firstItem() }} to {{ $jadwals->lastItem() }} of {{ $jadwals->total() }} entries
            </div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <form method="GET" action="{{ route('jadwal.index') }}">
                    @csrf
                    <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search..." value="{{ Request::get('search') }}">
                </form>
                <form method="GET" action="{{ route('jadwal.index') }}">
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
                            <th class="uppercase text-xs whitespace-nowrap">No</th>
                            <th class="uppercase text-xs whitespace-nowrap">Bis</th>
                            <th class="uppercase text-xs whitespace-nowrap">Tanggal</th>
                            <th class="uppercase text-xs whitespace-nowrap">Posisi Bis</th>
                            <th class="uppercase text-xs whitespace-nowrap">Pemesan</th>
                            <th class="uppercase text-xs whitespace-nowrap">Phone</th>
                            <th class="uppercase text-xs">Jml Bis</th>
                            <th class="uppercase text-xs">Tanggal Brkt/Pulang</th>
                            <th class="uppercase text-xs whitespace-nowrap">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $data)
                        <tr>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $jadwals->firstItem() + $loop->index }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->bis->nobody }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->tanggal }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->posisis->name }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->pemesanans->nama_pemesan }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->pemesanans->phone }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->pemesanans->jml_bis }}</td>
                            <td class="w-20">
                                <a href="" class="uppercase text-xs">{{ date('d/m/Y', strtotime($data->pemesanans->tgl_brkt)) }}</a>
                                <div class="uppercase text-xs">{{ date('d/m/Y', strtotime($data->pemesanans->tgl_pulang)) }}</div>
                            </td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->pemesanans->status }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->keterangan }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->user->name }}</td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('jadwal.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                    <form
                                        class="flex items-center text-danger"
                                        method="POST"
                                        action="{{ route('jadwal.destroy', $data->id) }}"
                                        onsubmit="return confirm('Are you sure?');"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $jadwals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
