<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('pembayaran.index') }}" class="intro-y text-lg font-medium mt-10">
            Daftar Pembayaran
        </a>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('pembayaran.create') }}" class="btn btn-primary shadow-md mr-2">Add pembayaran </a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="{{ route('pemesanan.pdf') }}" class="dropdown-item" id="print-pdf">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hidden xl:block mx-auto text-slate-500">
                    Showing {{ $pembayarans->firstItem() }} to {{ $pembayarans->lastItem() }} of {{ $pembayarans->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <form method="GET" action="{{ route('pembayaran.index') }}">
                            @csrf
                            <div class="pos intro-y grid grid-cols-8 gap-4 mt-5">
                                <div class="col-span-12 lg:col-span-4">
                                    <label for="start_date" class="form-label">Mulai Tanggal</label>
                                    <input type="text" name="start_date" id="start_date" class="datepicker form-control w-26 block mx-auto" data-single-mode="true"
                                    placeholder="Pilih tanggal mulai"
                                    value="{{ Request::get('start_date') ? date('d/m/Y', strtotime(Request::get('start_date'))) : '' }}">
                                    {{-- <input type="text" name="start_date" id="tgl_brkt" class="datepicker form-control w-26 block mx-auto" data-single-mode="true" placeholder="Pilih tanggal mulai" value="{{ Request::get('start_date') }}"> --}}
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <label for="end_date" class="form-label">Sampai Tanggal</label>
                                    <input type="text" name="end_date" id="end_date" class="datepicker form-control w-26 block mx-auto" data-single-mode="true"
                                    placeholder="Pilih tanggal selesai"
                                    value="{{ Request::get('end_date') ? date('d/m/Y', strtotime(Request::get('end_date'))) : '' }}">
                                    {{-- <input type="text" name="end_date" id="tgl_brkt" class="datepicker form-control w-26 block mx-auto" data-single-mode="true" placeholder="Pilih tanggal selesai" value="{{ Request::get('end_date') }}"> --}}
                                </div>
                            </div>
                            <div class="intro-y col-span-12 overflow-auto mt-2">
                                <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         <!-- BEGIN: Data List -->
         <div class="intro-y col-span-12 overflow-auto">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Nomor Invoice</th>
                        <th class="uppercase text-xs whitespace">Tanggal Bayar</th>
                        <th class="uppercase text-xs whitespace">Kode Pembayaran</th>
                        <th class="uppercase text-xs whitespace">Jumlah Bayar</th>
                        <th class="uppercase text-xs whitespace">Discount</th>
                        <th class="uppercase text-xs whitespace">Jenis Pembayaran</th>
                        <th class="uppercase text-xs whitespacep">Keterangan</th>
                        <th class="uppercase text-centeruppercase text-xs whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembayarans as $data)
                        <tr class="intro-x">
                            <td class="w-20">
                                <a href="{{ route('pemesanan.show', ['id' => $data->pemesanan->id]) }}" class="uppercase text-xs whitespace-nowrap">
                                    <span class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $data->nomorPembayaran }} </span>
                                </a>
                                <div class="uppercase text-xs">{{ $data->pemesanan->nama_pemesan }}</div>
                            </td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->tgl_bayar }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->kode_pembayaran }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->jml_bayar, 0, ',', '.') }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->discount, 0, ',', '.') }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->jenis_bayar }}</td>
                            <td class="uppercase text-xs whitespace-nowrap">{{ $data->keterangan }}</td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">

                                    <a href="{{ route('pembayaran.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5">
                                         <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                        <form class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('pembayaran.destroy', $data->id) }}" data-tw-toggle="modal"
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
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{  $pembayarans->links() }}
        </div>
         <!-- BEGIN: Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        @if (isset($data))
                            <form method="POST"action="{{ route('pembayaran.destroy', $data->id) }}">
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
