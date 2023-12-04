<x-app-layout>
    {{-- <div class="grid grid-cols-12 gap-6 mt-5">
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
                    <div class="text-3xl font-medium leading-8 mt-6">Bis Dipesan : {{ $totalBisDipesan }}</div>
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
                    <div class="text-3xl font-medium leading-8 mt-6">Bis Dipesan : {{ $totalBisDipesan }}</div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="mt-10">
        <a href="{{ route('pemesanan.index') }}" class="text-lg font-medium mr-auto">
            Daftar Pemesanan Wisata
        </a>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary shadow-md mr-2">Tambah </a>
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
                <div class="flex w-full sm:w-auto">
                    <form method="GET" action="{{ route('pemesanan.index') }}">
                        @csrf
                        <input type="text" name="search" class="form-control w-40 box pr-10" placeholder="Search...">
                        <input type="text" name="start_date" id="start_date" class="datepicker form-control w-40 box pr-10 ml-2" data-single-mode="true"
                        value="{{ Request::get('start_date') }}">
                        <input type="text" name="end_date" id="end_date" class="datepicker form-control w-40 box pr-10 ml-2 mt-2" data-single-mode="true"
                        value="{{ Request::get('end_date') }}">

                        <button type="submit" class="btn btn-primary shadow-md mr-2">
                            <i data-lucide="Search" class="w-4 h-4 mr-2"></i> Search
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto">
            <table class="table table-report -mt-2">
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
    </div>
</x-app-layout>
