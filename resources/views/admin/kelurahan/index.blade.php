<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('kelurahans.index') }}" class="intro-y text-lg font-medium mt-10">
            Daftar Kelurahan
        </a>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('kelurahans.create') }}" class="btn btn-primary shadow-md mr-2">Add New Kelurahan</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="#" class="dropdown-item" id="print-pdf">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print PDF
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kelurahan.view-pdf', ['print_search' => true, 'search' => $search]) }}" class="dropdown-item" target="_blank">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print PDF (Hasil Pencarian)
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kelurahan.view-pdf', ['per_page' => 100]) }}" class="dropdown-item" target="_blank">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print PDF (10 per halaman)
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('kelurahan.view-pdf', ['per_page' => 'all']) }}" class="dropdown-item" target="_blank">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print PDF (All)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hidden xl:block mx-auto text-slate-500">
                    Showing {{ $kelurahans->firstItem() }} to {{ $kelurahans->lastItem() }} of {{ $kelurahans->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <form method="GET" action="{{ route('kelurahans.index') }}">
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
                            <th class="whitespace-nowrap">No.</th>
                            <th class="whitespace-nowrap">Kelurahan</th>
                            <th class="whitespace-nowrap">Kecamatan</th>
                            <th class="whitespace-nowrap">Dapil</th>
                            <th class="whitespace-nowrap">Kota/Kabupaten</th>
                            <th class="whitespace-nowrap">Provinsi</th>
                            <th class="whitespace-nowrap">Kode Pos</th>
                            <th class="text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelurahans as $kelurahan)
                            <tr class="intro-x">
                                <td>{{ $kelurahans->firstItem() + $loop->index }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $kelurahan->name  }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $kelurahan->kecamatan }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $kelurahan->dapil }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $kelurahan->kabkota }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $kelurahan->provinsi }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $kelurahan->kodepos }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('kelurahans.edit', $kelurahan->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        <form
                                            class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('kelurahans.destroy', $kelurahan->id) }}"
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
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                {{-- {{  $kelurahans->links() }} --}}
                {{ $kelurahans->appends(['search' => request('search')])->links() }}
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    <ul class="pagination">
                        <li class="page-item {{ ($kelurahans->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $kelurahans->url(1) }}">
                                <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                            </a>
                        </li>
                        <li class="page-item {{ ($kelurahans->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $kelurahans->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </a>
                        </li>
                        @if($kelurahans->currentPage() > 2)
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif
                        @for($i = $kelurahans->currentPage() - 1; $i <= $kelurahans->currentPage() + 1; $i++)
                            @if($i > 0 && $i <= $kelurahans->lastPage())
                                <li class="page-item {{ ($i == $kelurahans->currentPage()) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $kelurahans->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        @if($kelurahans->currentPage() < $kelurahans->lastPage() - 1)
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif

                        <li class="page-item {{ ($kelurahans->currentPage() == $kelurahans->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $kelurahans->nextPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </a>
                        </li>

                        <li class="page-item {{ ($kelurahans->currentPage() == $kelurahans->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $kelurahans->url($kelurahans->lastPage()) }}">
                                <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <select class="w-20 form-select box mt-3 sm:mt-0" onchange="window.location.href = this.value">
                    @foreach([10, 25, 50, 100] as $perPage)
                        <option value="{{ $kelurahans->url(1) . '&per_page=' . $perPage }}" {{ ($perPage == $kelurahans->perPage()) ? 'selected' : '' }}>
                            {{ $perPage }}
                        </option>
                    @endforeach
                </select>
            </div> --}}
            <!-- END: Pagination -->

        </div>
    </div>
    <script>
        document.getElementById("print-pdf").addEventListener("click", function() {
            var page = prompt("Enter the page number:");
            if (page != null && page != "") {
                var url = "{{ route('kelurahan.view-pdf') }}?page=" + page;
                window.open(url, "_blank");
            }
        });
    </script>
</x-app-layout>
