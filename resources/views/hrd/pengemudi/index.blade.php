<x-app-layout>
    <a href="{{ route('pengemudi.index') }}" class="intro-y text-lg font-medium mt-10">
        Data pengemudi
    </a>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('pengemudi.create') }}" class="btn btn-primary shadow-md mr-2">Add New pengemudi</a>
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
                Showing {{ $pengemudi->firstItem() }} to {{ $pengemudi->lastItem() }} of {{ $pengemudi->total() }} entries</div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('pengemudi.index') }}">
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
                        <th class="uppercase text-xs">No.</th>
                        <th class="uppercase text-xs">NIK & Nama</th>
                        <th class="uppercase text-xs">Nomor Induk</th>
                        <th class="uppercase text-xs">Rute</th>
                        <th class="uppercase text-xs">Tanggal KP</th>
                        <th class="uppercase text-xs">Nomor SIM</th>
                        <th class="uppercase text-xs">Jenis SIM</th>
                        <th class="uppercase text-xs">Berlaku SIM</th>
                        <th class="uppercase text-xs">No.Jamsostek</th>
                        <th class="uppercase text-xs">Tanggal Jamsostek</th>
                        <th class="uppercase text-xs">Keaktifan</th>
                        <th class="uppercase text-xs">Keteranagan</th>
                        <th class="uppercase text-xs whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengemudi as $data)
                    <tr class="intro-x">
                        <td>{{ $pengemudi->firstItem() + $loop->index }}</td>
                        <td class="w-20">
                            <a href="" class="uppercase text-xs whitespace-nowrap {{ $duplicateNikCount->get($data->nik, 1) > 1 ? 'text-red-500' : '' }}">{{ $data->nik }}</a>
                            @if($data->biodata)
                                <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->biodata->nama }}</div>
                            @else
                                <div class="uppercase text-xs text-red-500 whitespace-nowrap mt-0.5">Data Biodata Tidak Tersedia</div>
                            @endif
                        </td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nopengemudi }}</td>
                        <td class="w-20">
                            <a href="{{ route('pengemudi.show', ['id' => $data->id]) }}" class="fuppercase text-xs whitespace-nowrap">{{ $data->rute->koderute }}</a>
                            <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->rute->namarute }}</div>
                        </td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_kp }}</td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nosim }}</td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->jenis_sim }}</td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_sim }}</td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nojamsostek }}</td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_jamsos }}</td>
                        <td class="uppercase text-xs w-20 ">
                            @if ($data->status == 'AKTIF')
                                <label class="flex items-left justify-left text-success">AKTIF</label>
                            @elseif ($data->status == 'BERMASALAH')
                                <label class="flex items-left justify-left text-danger">BERMASALAH</label>
                            @elseif ($data->status == 'NONAKTIF')
                                <label class="flex items-left justify-left text-warning">NONAKTIF</label>
                            @elseif ($data->status == 'KELUAR')
                                <label class="flex items-left justify-left text-warning">KELUAR</label>
                            {{-- @else
                                <label class="flex items-left justify-left text-info">Data Tidak Diketahui</label> --}}
                            @endif
                        </td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->keterangan }}</td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('pengemudi.edit', $data->id) }}" class="flex items-center uppercase text-xs text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                    <form class="flex items-center text-danger"
                                        method="POST"
                                        action="{{ route('pengemudi.destroy', $data->id) }}" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="p-2 m-2">
                {{ $pengemudi->links() }}
            </div>
            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            @if (isset($data))
                                <form method="POST" action="{{ route('pengemudi.destroy', $data->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="p-5 text-center">
                                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                        <div class="text-3xl mt-5">Yakin Mau di Hapus ?</div>
                                        <div class="text-slate-500 mt-2">Jangan Sampai Menyesal? <br>Proses ini tidak dapat dibatalkan.</div>
                                    </div>
                                    <div class="px-5 pb-8 text-center">
                                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                        <button type="submit" class="btn btn-danger w-24">Delete</button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center mt-5">Data tidak ditemukan.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Tambahkan event listener ke tombol Delete
        document.querySelectorAll('[data-tw-toggle="modal"]').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-tw-target');
                const modal = document.querySelector(target);
                modal.classList.add('open');
            });
        });
    </script>
</x-app-layout>
