<x-app-layout>
    <div class="intro-y flex items-center mt-8">
        <a href="{{ route('biss.index') }}" class="text-lg font-medium mr-auto">
            Daftar biss Wisata
        </a>
    </div>
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="grid grid-cols-11 gap-x-6 pb-20">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center">
            <a href="{{ route('biss.create') }}" class="btn btn-primary shadow-md mr-2">Add biss </a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="{{ route('bis.view-pdf', [
                                'start_date' => Request::get('start_date'),
                                'end_date' => Request::get('end_date')
                                ]) }}" class="dropdown-item">
                                <i data-lucide="file-text" target="_blank" class="w-4 h-4 mr-2"></i>Export PDF
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="hidden xl:block mx-auto text-slate-500">
                Showing {{ $buses->firstItem() }} to {{ $buses->lastItem() }} of {{ $buses->total() }} entries
            </div>
            <div class="flex items-center justify-between w-64 text-slate-500">
                <form method="GET" action="{{ route('biss.index') }}">
                    @csrf
                    <input type="text" name="search" class="form-control w-44 box pr-10" placeholder="Search...">
                </form>
                <button type="submit" class="btn btn-primary ml-2 mr-4">Search</button>
            </div>
        </div>
        <!-- BEGIN: List Table -->
        <div class="intro-y col-span-8 2xl:col-span-9">
            <div class="intro-y col-span-12 overflow-auto">
                <table class="table table-report">
                    <thead>
                        <tr>
                            <th class="uppercase text-xs whitespace-nowrap">No.</th>
                            <th class="uppercase text-xs whitespace-nowrap">No.Body</th>
                            <th class="uppercase text-xs whitespace-nowrap">No.Polisi</th>
                            <th class="uppercase text-xs whitespace-nowrap">No Chassis/Mesin</th>
                            <th class="uppercase text-xs whitespace-nowrap">Route / Pool</th>
                            <th class="uppercase text-xs whitespace-nowrap">Merk / Tahun</th>
                            <th class="uppercase text-xs whitespace-nowrap">Jenis / Seat</th>
                            <th class="uppercase text-xs whitespace-nowrap">Izin Trayek</th>
                            <th class="uppercase text-xs whitespace-nowrap">Nomor Uji</th>
                            <th class="uppercase text-xs whitespace-nowrap">STNK Awal/Akhir</th>
                            <th class="uppercase text-xs whitespace-nowrap">Tanggal KIR</th>
                            <th class="uppercase text-xs whitespace-nowrap">Tanggal KPS</th>
                            <th class="uppercase text-xs whitespace-nowrap">Kondisi</th>
                            <th class="uppercase text-xs whitespace-nowrap">Keterangan</th>
                            <th class="uppercase text-xs whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buses as $data)
                            <tr class="intro-x">
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $buses->firstItem() + $loop->index }}</td>
                                <td class="uppercase text-xs font-medium whitespace-nowrap">{{ $data->nobody }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nopolisi }}</td>
                                <td class="w-20">
                                    <span class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nochassis }}</span>
                                    <div class="upperct-smuppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nomesin }}</div>
                                </td>
                                <td class="w-20">
                                    <a href="{{ route('bisrekaps.index') }}" class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->rutes->koderute }}</a>
                                    <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->pools->nama_pool }}</div>
                                </td>
                                <td class="w-20">
                                    <span class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->merk }}</span>
                                    <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tahun }}</div>
                                </td>
                                <td class="w-20">
                                    <span class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->jenis }}</span>
                                    <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->seat }}</div>
                                </td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->izintrayek }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->nomor_uji }}</td>
                                <td class="w-20">
                                    <span class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_stnk }}</span>
                                    <div class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_stnk2 }}</div>
                                </td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_kir }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->tgl_kps }}</td>
                                <td class="uppercase text-xs w-20">
                                    @if ($data->kondisi == 'AKTIF')
                                        <label class="flex items-left justify-left text-success">AKTIF</label>
                                    @elseif ($data->kondisi =='NONAKTIF')
                                        <label class="flex items-left justify-left text-primary">NONAKTIF</label>
                                        @elseif ($data->kondisi =='KARESORI')
                                        <label class="flex items-left justify-left text-warning">KARESORI</label>
                                    @elseif ($data->kondisi =='LAKA')
                                        <label class="flex items-left justify-left text-danger">LAKA</label>
                                    @elseif ($data->kondisi =='UPKIR')
                                        <label class="flex items-left justify-left text-danger">UPKIR</label>
                                    @else
                                    @endif
                                </td>
                                <td class="uppercase text-xs whitespace-nowrap">{{ $data->keterangan }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('biss.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        <form
                                            class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('biss.destroy', $data->id) }}"
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
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                {{ $buses->appends(['search' => request('search')])->links() }}
            </div>
        </div>

        <!-- Sebelah Kanan -->
        <div class="intro-y col-span-2 hidden 2xl:block">
            <div class="mt-10 bg-warning/20 dark:bg-darkmode-600 border border-warning dark:border-0 rounded-md relative p-5">
                <div class="mt-6">
                    <div class="h-[290px]">
                        <canvas id="report-bar-chart-1"></canvas>
                    </div>
                </div>
            </div>
            <div class="pt-10 sticky top-0">
                <ul class="text-slate-500 relative before:content-[''] before:w-[2px] before:bg-slate-200 before:dark:bg-darkmode-600 before:h-full before:absolute before:left-0 before:z-[-1]">
                    <li class="mb-4 border-l-2 pl-5 border-primary dark:border-primary text-primary font-medium"> <a href="">Upload Product</a> </li>
                    <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent"> <a href="">Product Information</a> </li>
                    <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent"> <a href="">Product Detail</a> </li>
                    <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent"> <a href="">Product Variant</a> </li>
                    <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent"> <a href="">Product Variant (Details)</a> </li>
                    <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent"> <a href="">Product Management</a> </li>
                    <li class="mb-4 border-l-2 pl-5 border-transparent dark:border-transparent"> <a href="">Weight & Shipping</a> </li>
                </ul>
                <div class="mt-10 bg-warning/20 dark:bg-darkmode-600 border border-warning dark:border-0 rounded-md relative p-5">
                    <i data-lucide="lightbulb" class="w-12 h-12 text-warning/80 absolute top-0 right-0 mt-5 mr-3"></i>
                    <h2 class="text-lg font-medium">
                        Catatan
                    </h2>
                    <div class="mt-5 font-medium">Price</div>
                    <div class="leading-relaxed text-xs mt-2 text-slate-600 dark:text-slate-500">
                        <div>The image format is .jpg .jpeg .png and a minimum size of 300 x 300 pixels (For optimal images use a minimum size of 700 x 700 pixels).</div>
                        <div class="mt-2">Select product photos or drag and drop up to 5 photos at once here. Include min. 3 attractive photos to make the product more attractive to buyers.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    @if (isset($data))
                        <form method="POST"action="{{ route('biss.destroy', $data->id) }}">
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
