<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('perusahaans.index') }}" class="intro-y text-lg font-medium mt-10">
            Inventory Perusahaan
        </a>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('perusahaans.create') }}" class="btn btn-primary shadow-md mr-2">New Perusahaan</a>
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
                    Showing {{ $perusahaans->firstItem() }} to {{ $perusahaans->lastItem() }} of {{ $perusahaans->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <form method="GET" action="{{ route('perusahaans.index') }}">
                            @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                        </form>
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                    {{-- <select id="kondisi" name="kondisi" class="w-56 xl:w-auto form-select box ml-2">
                        @foreach (App\Enums\TableKondisi::cases() as $kondisi)
                            <option value="{{ $kondisi->value }}">{{ $kondisi->name }}</option>
                        @endforeach
                    </select> --}}
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap ml-4">
                                <input id="checkAll" class="form-check-input" type="checkbox">
                            </th>
                            <th class="whitespace-nowrap">No.</th>
                            <th class="whitespace-nowrap">Nama Perusahaan</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perusahaans as $perusahaan)
                            <tr class="intro-x">
                                <td class="w-10">
                                    <input class="form-check-input" type="checkbox" name="selected[]" value="{{ $perusahaan->id }}">
                                </td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $perusahaan->id }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $perusahaan->name }}</td>

                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('perusahaans.edit', $perusahaan->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        <form
                                            class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('perusahaans.destroy', $perusahaan->id) }}"
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
            <!-- END: Data List -->

            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    <ul class="pagination">
                        <li class="page-item {{ ($perusahaans->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $perusahaans->url(1) }}">
                                <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                            </a>
                        </li>
                        <li class="page-item {{ ($perusahaans->currentPage() == 1) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $perusahaans->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </a>
                        </li>
                        @if($perusahaans->currentPage() > 2)
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif
                        @for($i = $perusahaans->currentPage() - 1; $i <= $perusahaans->currentPage() + 1; $i++)
                            @if($i > 0 && $i <= $perusahaans->lastPage())
                                <li class="page-item {{ ($i == $perusahaans->currentPage()) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $perusahaans->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        @if($perusahaans->currentPage() < $perusahaans->lastPage() - 1)
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif

                        <li class="page-item {{ ($perusahaans->currentPage() == $perusahaans->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $perusahaans->nextPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </a>
                        </li>

                        <li class="page-item {{ ($perusahaans->currentPage() == $perusahaans->lastPage()) ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $perusahaans->url($perusahaans->lastPage()) }}">
                                <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <select class="w-20 form-select box mt-3 sm:mt-0" onchange="window.location.href = this.value">
                    @foreach([10, 25, 50, 100] as $perPage)
                        <option value="{{ $perusahaans->url(1) . '&per_page=' . $perPage }}" {{ ($perPage == $perusahaans->perPage()) ? 'selected' : '' }}>
                            {{ $perPage }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- END: Pagination -->

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#checkAll').click(function() {
                $('input:checkbox').prop('checked', this.checked);
            });
        });
    </script>
</x-app-layout>
