<x-app-layout>
    <a href="{{ route('kondektur.index') }}" class="intro-y text-lg font-medium mt-10">
        Data kondektur
    </a>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('kondektur.create') }}" class="btn btn-primary shadow-md mr-2">Add New kondektur</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="#" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500">
                Showing {{ $kondektur->firstItem() }} to {{ $kondektur->lastItem() }} of {{ $kondektur->total() }} entries</div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('kondektur.index') }}">
                        @csrf
                    <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    </form>
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        {{-- <th class="whitespace-nowrap">
                            <input class="form-check-input" type="checkbox">
                        </th> --}}
                        <th class="whitespace-nowrap">No.</th>
                        <th class="whitespace-nowrap">NIK & Nama</th>
                        <th class="whitespace-nowrap">Nomor Induk</th>
                        <th class="whitespace-nowrap">Rute</th>
                        <th class="whitespace-nowrap">Tanggal KP</th>
                        <th class="whitespace-nowrap">No.Jamsostek</th>
                        <th class="whitespace-nowrap">Tgl Jamsostek</th>
                        <th class="whitespace-nowrap">Keaktifan</th>
                        <th class="whitespace-nowrap">Keteranagan</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kondektur as $data)
                    <tr class="intro-x">
                        <td>{{ $kondektur->firstItem() + $loop->index }}</td>
                        <td class="w-20">
                            <a href="" class="font-medium whitespace-nowrap {{ $duplicateNikCount->get($data->nik, 1) > 1 ? 'text-red-500' : '' }}">{{ $data->nik }}</a>
                            @if($data->biodata)
                                <div class="text-sm whitespace-nowrap mt-0.5">{{ $data->biodata->nama }}</div>
                            @else
                                <div class="text-sm text-red-500 whitespace-nowrap mt-0.5">Data Biodata Tidak Tersedia</div>
                            @endif
                        </td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->nokondektur }}</td>
                        <td class="w-20">
                            <a href="{{ route('kondektur.show', ['id' => $data->id]) }}" class="font-medium whitespace-nowrap">{{ $data->rute->koderute }}</a>
                            <div class="text-sm whitespace-nowrap mt-0.5">{{ $data->rute->namarute }}</div>
                        </td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->tgl_kp }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->nojamsostek }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->tgl_jamsos }}</td>
                        <td class="w-20">
                            @if ($data->status == 'AKTIF')
                                <label class="flex items-left justify-left text-success">AKTIF</label>
                            @elseif ($data->status =='NONAKTIF')
                                <label class="flex items-left justify-left text-primary">NONAKTIF</label>
                            @elseif ($data->status =='BERMASALAH')
                                <label class="flex items-left justify-left text-warning">BERMASALAH</label>
                                @elseif ($data->status =='KELUAR')
                                <label class="flex items-left justify-left text-danger">KELUAR</label>
                            @endif
                        </td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->keterangan }}</td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('kondektur.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <form
                                    class="flex items-center text-danger"
                                    method="POST"
                                    action="{{ route('kondektur.destroy', $data->id) }}"
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
            <div class="p-2 m-2">
                {{ $kondektur->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
