<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-lucide="bus" class="report-box__icon text-primary"></i>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6"> Bis Yang Ada : {{ $totalBisTersedia }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-lucide="credit-card" class="report-box__icon text-pending"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="Tanggal Ketersediaan">
                                {{ date('d-m-Y', strtotime($formattedStartDate)) }} <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    <div class="text-3xl font-medium leading-8 mt-6">Bis Tersedia : {{ $stokBisHariIni }}</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <i data-lucide="credit-card" class="report-box__icon text-pending"></i>
                        <div class="ml-auto">
                            <div class="report-box__indicator bg-warning tooltip cursor-pointer" title="Tanggal Pemesanan">
                                {{ date('d-m-Y', strtotime($formattedStartDate)) }} <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="text-3xl font-medium leading-8 mt-6">Bis Pulang : {{ $totalTglPulang }} hari</div> --}}

                    <div class="text-3xl font-medium leading-8 mt-6">Bis Dipesan : {{ $totalBisDipesan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <a href="{{ route('pemesanan.index') }}" class="text-lg font-medium mr-auto">
            Daftar Pemesanan Wisata
        </a>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('pemesanan.create') }}" class="btn btn-primary shadow-md mr-2">Add pemesanan </a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="{{ route('pemesanan.pdf', [
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
                    Showing {{ $pemesanans->firstItem() }} to {{ $pemesanans->lastItem() }} of {{ $pemesanans->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 ml-2 xl:mt-0">
                    <form method="GET" action="{{ route('pemesanan.index') }}">
                        @csrf
                    <input type="text" name="search" class="form-control w-40 box pr-10" placeholder="Search...">
                    </form>
                    {{-- <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> --}}
                    <form method="GET" action="{{ route('pemesanan.index') }}">
                        <input type="text" name="start_date" id="start_date" class="datepicker form-control w-40 box pr-10 ml-2" data-single-mode="true"
                        value="{{ Request::get('start_date') }}">
                        <input type="text" name="end_date" id="end_date" class="datepicker form-control w-40 box pr-10 ml-2 mt-2" data-single-mode="true"
                        value="{{ Request::get('end_date') }}">
                        <button type="submit" class="btn btn-primary shadow-md mr-2"> <i data-lucide="Search" class="w-4 h-4 ml-2"></i> Search</button>
                    </form>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto">
                <table class="table table-report -mt-2">
                    <table class="table table-report">
                        <thead>
                            <tr>
                                <th class="uppercase text-xs whitespace-nowrap">Nama.Pemesan Phone</th>
                                <th class="uppercase text-xs">Alamat</th>
                                <th class="uppercase text-xs">Tujuan / Pemakaian</th>
                                <th class="uppercase text-xs">Tanggal Brkt/Pulang</th>
                                <th class="uppercase text-xs">Durasi Hari</th>
                                <th class="uppercase text-xs">Armada</th>
                                <th class="uppercase text-xs">Harga</th>
                                <th class="uppercase text-xs">Jml Bis</th>
                                <th class="uppercase text-xs">Biaya Jemput</th>
                                <th class="uppercase text-xs">Total Harga</th>
                                <th class="uppercase text-xs">Jam Jemput</th>
                                <th class="uppercase text-xs">Pool</th>
                                <th class="uppercase text-xs">Status</th>
                                <th class="uppercase text-xs">User</th>
                                <th class="uppercase text-xs">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $data)
                                <tr class="intro-x">
                                    <td class="w-20">
                                        <a href="{{ route('pembayaran.show', ['nomorPembayaran' => $data->id]) }}" class="uppercase text-xs whitespace-nowrap mt-0.5"><b>{{ $data->nama_pemesan }}</b></a>

                                        {{-- <a href="{{ route('pembayaran.show', ['pembayarans' => $data->id]) }}" class="uppercase text-xs whitespace-nowrap">{{ $data->nama_pemesan }}</a> --}}
                                        <div class="uppercase text-xs">{{ $data->phone }}</div>
                                    </td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->alamat }}</td>
                                    <td class="w-20">
                                        <span class="uppercase text-xs whitespace-nowrap">{{ $data->tujuans->tujuan }}</span>
                                        <div class="uppercase text-xs">{{ $data->tujuans->pemakaian }}</div>
                                    </td>
                                    <td class="w-20">
                                        <a href="" class="uppercase text-xs">{{ date('d/m/Y', strtotime($data->tgl_brkt)) }}</a>
                                        <div class="uppercase text-xs">{{ date('d/m/Y', strtotime($data->tgl_pulang)) }}</div>
                                    </td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->durasi_hari }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->armadas->jenis_armada }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->harga, 0, ',', '.') }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->jml_bis }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->biaya_jemput, 0, ',', '.') }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->total_harga, 0, ',', '.') }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->jam_jemput }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->pools->nama_pool }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->status }}</td>
                                    <td class="uppercase text-xs whitespace-nowrap">{{ $data->user->name }}</td>
                                    <td class="table-report__action">
                                        <div class="flex justify-center items-center">

                                            <a href="{{ route('pemesanan.edit', $data->id) }}" class="flex items-center text-xs text-primary whitespace-nowrap mr-5">
                                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                            </a>
                                            @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                            <form class="flex items-center text-xs text-danger"
                                                method="POST"
                                                action="{{ route('pemesanan.destroy', $data->id) }}" data-tw-toggle="modal"
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
                    {{  $pemesanans->links() }}
                </div>
            </div>

            <!-- Sebelah Kanan -->
            {{-- <div class="intro-y col-span-2 hidden 2xl:block">
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
            </div> --}}
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        @if (isset($data))
                            <form method="POST"action="{{ route('pemesanan.destroy', $data->id) }}">
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

    var start_date_input = document.getElementById('start_date');
    var end_date_input = document.getElementById('end_date');

    // Gunakan library datepicker lain yang mendukung inisialisasi beberapa kali pada elemen yang sama
    var start_date_picker = new Datepicker(start_date_input, {
    format: 'DD-MM-YYYY' // Atur format tanggal yang diinginkan di sini
    });
    var end_date_picker = new Datepicker(end_date_input, {
    format: 'DD-MM-YYYY'
    });
</script>


</x-app-layout>
