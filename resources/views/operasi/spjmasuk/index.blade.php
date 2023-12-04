<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('spj-masuk.index') }}" class="intro-y text-lg font-medium mt-10">
            Daftar SPJ Masuk
        </a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('spj-masuk.create') }}" class="btn btn-primary shadow-md mr-2">Add Spj Masuk</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
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
                    Showing {{ $spjmasuks->firstItem() }} to {{ $spjmasuks->lastItem() }} of {{ $spjmasuks->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-2 xl:mt-0 mr-3 right-0">
                    <form method="GET" action="{{ route('spj-masuk.index') }}">
                        @csrf
                        <div class="w-58 sm:w-auto ml-2 mt-2">
                            <li>
                                <input type="date" name="start_date" id="start_date" class="datepicker form-control w-40 box pr-10" data-single-mode="true" placeholder="Mulai Tanggal" value="{{ Request::get('start_date') }}">

                                <input type="date" name="end_date" id="end_date" class="datepicker form-control w-40 box pr-10" data-single-mode="true" placeholder="s/d Tanggal" value="{{ Request::get('end_date') }}">
                            </li>
                            </div>
                        <div class="w-58 sm:w-auto mt-2">
                            <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                            <button type="submit" class="btn btn-primary ml-10 mr-4">
                                <i data-lucide="search" class="w-8 h-4 ml-2"></i> Cari
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="uppercase text-xs whitespace-nowrap">No.</th>
                            <th class="uppercase text-xs whitespace-nowrap">No.Spj Keluar</th>
                            <th class="uppercase text-xs whitespace-nowrap">Posisi</th>
                            <th class="uppercase text-xs">Tgl Masuk Tgl Keluar</th>
                            <th class="uppercase text-xs">KM.Masuk KM.Keluar</th>
                            <th class="uppercase text-xs whitespace-nowrap">Total KM</th>
                            <th class="uppercase text-xs whitespace-nowrap">Biaya BBM</th>
                            <th class="uppercase text-xs whitespace-nowrap">Uang Makan</th>
                            <th class="uppercase text-xs whitespace-nowrap">Biaya Tol</th>
                            <th class="uppercase text-xs whitespace-nowrap">Biaya Parkir</th>
                            <th class="uppercase text-xs whitespace-nowrap">Biaya Lain</th>
                            <th class="uppercase text-xs whitespace-nowrap">Total Biaya</th>
                            <th class="uppercase text-xs whitespace-nowrap">Keterangan</th>
                            <th class="uppercase text-xs whitespace-nowrap">User</th>
                            <th class="uppercase text-xs whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spjmasuks as $data)
                            <tr class="intro-x">
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $spjmasuks->firstItem() + $loop->index }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->spjkeluars->nomorspj }}</td>
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $data->spjkeluars->posisis->name }}</td>
                                <td class="w-20">
                                    <span class="text-sm whitespace-nowrap mt-0.5">{{ $data->tgl_masuk }}</span>
                                    <div class="text-sm whitespace-nowrap mt-0.5">{{ $data->spjkeluars->tgl_klr }}</div>
                                </td>
                                <td class="w-20">
                                    <span class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->kmmasuk, 0, ',', '.') }}</span>
                                    <div class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->spjkeluars->kmkeluar, 0, ',', '.') }}</div>
                                </td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($totalKm, 0, ',', '.') }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->biaya_bbm , 0, ',', '.')}}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->uang_makan, 0, ',', '.') }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->biaya_tol, 0, ',', '.') }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->parkir, 0, ',', '.') }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->biaya_lain, 0, ',', '.') }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($totalBiaya, 0, ',', '.') }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->keterangan_spjmasuk }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->user->name }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('spj-masuk.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5"
                                            href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                            <form
                                                class="flex items-center text-danger"
                                                method="POST"
                                                action="{{ route('spj-masuk.destroy', $data->id) }}"
                                                onsubmit="return confirm('Are you sure?');"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
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
        </div>
    </div>
</x-app-layout>
