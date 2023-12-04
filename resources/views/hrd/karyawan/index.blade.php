<x-app-layout>
    <a href="{{ route('karyawans.index') }}" class="intro-y text-lg font-medium mt-10">
        Data karyawan
    </a>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('karyawans.create') }}" class="btn btn-primary shadow-md mr-2">Add New karyawan</a>
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
                Showing {{ $karyawans->firstItem() }} to {{ $karyawans->lastItem() }} of {{ $karyawans->total() }} entries
            </div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('karyawans.index') }}">
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
                        {{-- <th class="uppercase text-xs whitespace-nowrap">
                            <input class="form-check-input" type="checkbox">
                        </th> --}}
                        <th class="uppercase text-xs whitespace-nowrap">No.</th>
                        <th class="uppercase text-xs whitespace-nowrap">Nik KTP </th>
                        <th class="uppercase text-xs whitespace-nowrap">No.Induk & Nama</th>
                        <th class="uppercase text-xs whitespace-nowrap">Jabatan</th>
                        <th class="uppercase text-xs whitespace-nowrap">Tanggal KP</th>
                        <th class="uppercase text-xs whitespace-nowrap">Tgl. Masuk</th>
                        <th class="uppercase text-xs whitespace-nowrap">Pendidikan</th>
                        <th class="uppercase text-xs whitespace-nowrap">Tinggi Bdn</th>
                        <th class="uppercase text-xs whitespace-nowrap">Berat Badan</th>
                        <th class="uppercase text-xs whitespace-nowrap">Nomor Jamsostek</th>
                        <th class="uppercase text-xs whitespace-nowrap">Tgl.Jamsostek</th>
                        <th class="uppercase text-xs whitespace-nowrap">User ID</th>
                        <th class="uppercase text-xs whitespace-nowrap">password</th>
                        <th class="uppercase text-xs whitespace-nowrap">Status</th>
                        <th class="uppercase text-xs whitespace-nowrap">Keteranagan</th>
                        <th class="text-center uppercase text-xs whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                    <tr class="intro-x">

                        <td>{{ $karyawans->firstItem() + $loop->index }}</td>
                        <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->nik }}</td>
                            <td class="w-40">
                                <a href="" class="font-medium uppercase text-xs whitespace-nowrap">{{ $karyawan->nokaryawan }}</a>
                                <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->biodata->nama }}</div>
                            </td>

                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->jabatan->name }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->tgl_kp }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->tgl_masuk }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->pendidikan }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->tinggi }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->gol_darah }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->nojamsostek }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->tgl_jamsos }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->users->name }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->password }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->status }}</td>
                            <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $karyawan->keterangan }}</td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="flex items-center text-primary uppercase text-xs whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                    @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                        <form class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('karyawans.destroy', $karyawan->id) }}" data-tw-toggle="modal"
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
                {{ $karyawans->links() }}
            </div>
            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            @if (isset($data))
                                <form method="POST" action="{{ route('karyawans.destroy', $karyawan->id) }}">
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
