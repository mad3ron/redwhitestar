<x-app-layout>
    <a href="{{ route('biodatas.index') }}" class="intro-y text-lg font-medium mt-10">
        Inventory Biodata
    </a>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-5">
            <a href="{{ route('biodatas.create') }}" class="btn btn-primary shadow-md mr-2">Add New Biodata</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="{{ route('biodata.view-pdf', ['per_page' => 'all']) }}" class="dropdown-item" target="_blank"><i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print</a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" target="_blank" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500">
                Showing {{ $biodatas->firstItem() }} to {{ $biodatas->lastItem() }} of {{ $biodatas->total() }} entries
            </div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('biodatas.index') }}">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    </form>
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
                <div class="ml-3">
                    <form id="export-pdf" method="GET" action="{{ route('biodata.view-pdf') }}" target="_blank">
                        @csrf
                        <input type="hidden" name="search" value="{{ request()->input('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Export PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto">
            {{-- @if(isset($biodatas) && count($biodatas) > 0) --}}
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    {{-- <th class="whitespace-nowrap">
                        <input class="form-check-input" type="checkbox">
                    </th> --}}
                    <th class="whitespace-nowrap">No.</th>
                    <th class="whitespace-nowrap">Nama/Jabatan</th>
                    <th class="whitespace-nowrap">Nomor KTP/KK</th>
                    <th class="whitespace-nowrap">Tempat/Tgl Lahir</th>
                    <th class="whitespace-nowrap">Agama</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="whitespace-nowrap">Jenis</th>
                    <th class="whitespace-nowrap">Alamat</th>
                    <th class="whitespace-nowrap">RT/RW</th>
                    <th class="whitespace-nowrap">Kelurahan/Kecamatan</th>
                    <th class="whitespace-nowrap">Phone</th>
                    <th class="whitespace-nowrap">Keaktifan</th>
                    <th class="text-center whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biodatas as $biodata)
                    <tr class="intro-x">
                        {{-- <td class="w-10">
                            <input class="form-check-input" type="checkbox">
                        </td> --}}
                        <td>{{ $biodatas->firstItem() + $loop->index }}</td>
                        <td class="w-20">
                            <span class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->nama }}</span>
                            <div class="text-xs whitespace-nowrap mt-0.5">{{ $biodata->jabatans->name }}</div>
                        </td>
                        <td class="w-20">
                            <span class="font-medium whitespace-nowrap">{{ $biodata->nik }}</span>
                            <div class="text-xs whitespace-nowrap mt-0.5">{{ $biodata->nokk }}</div>
                        </td>
                        <td class="w-20">
                            @if(isset($biodata->kotalahirs))
                                {{ $biodata->kotalahirs->tempat_lahir }}
                            @endif

                            <div class="text-xs whitespace-nowrap mt-0.5">{{ $biodata->tgl_lahir }}</div>
                        </td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->status }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->agama }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->jenis }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->alamat }}</td>
                        <td class="w-20">
                            <span class="font-medium whitespace-nowrap">{{ $biodata->rt }}</span>
                            <div class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->rw }}</div>
                        </td>
                        <td class="w-40">
                            @if(isset($biodata->kelurahans))
                                {{ $biodata->kelurahans->name}}
                                <div class="text-xs whitespace-nowrap mt-0.5">{{ $biodata->kelurahans->kecamatan }} - {{ $biodata->kelurahans->kabkota  }}</div>
                            @endif
                        </td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $biodata->phone }}</td>
                        <td class="w-40">
                            @if ($biodata->is_visible == 'Active')
                                <label class="flex items-left justify-left text-success">Active</label>
                            @elseif ($biodata->is_visible =='Inactive')
                                <label class="flex items-left justify-left text-primary">Inactive</label>
                            @elseif ($biodata->is_visible =='Disable')
                                <label class="flex items-left justify-left text-warning">Disable</label>
                            {{-- @else
                                <label class="flex items-left justify-left text-danger">Out</label> --}}
                            @endif
                        </td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('biodatas.edit', $biodata->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                    @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                        <form class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('biodatas.destroy', $biodata->id) }}" data-tw-toggle="modal"
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
        </div>
         <!-- BEGIN: Pagination -->
         <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $biodatas->appends(['search' => request('search')])->links() }}
        </div>
         <!-- BEGIN: Delete Confirmation Modal -->
         <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        @if (isset($biodata))
                            <form method="POST" action="{{ route('biodatas.destroy', $biodata->id) }}">
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
