<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('tujuan.index') }}" class="intro-y text-lg font-medium mt-10">
            Tujuan
        </a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('tujuan.create') }}" class="btn btn-primary shadow-md mr-2">Add Tujuan </a>
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
                        </ul>
                    </div>
                </div>
                <div class="hidden xl:block mx-auto text-slate-500">
                    Showing {{ $tujuans->firstItem() }} to {{ $tujuans->lastItem() }} of {{ $tujuans->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <form method="GET" action="{{ route('tujuan.index') }}">
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
                            <th class="whitespace-nowrap">Jenis Armada</th>
                            <th class="whitespace-nowrap">Tujuan</th>
                            <th class="whitespace-nowrap">Pemakaian</th>
                            <th class="whitespace-nowrap">Harga Dasar</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tujuans as $data)
                            <tr class="intro-x">
                                <td class="uppercase text-xs whitespace-nowrap mt-0.5">{{ $tujuans->firstItem() + $loop->index }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->armadas->jenis_armada }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->tujuan }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->pemakaian }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ number_format($data->harga_dasar, 0, ',', '.') }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('tujuan.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5"
                                            href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                            <form
                                                class="flex items-center text-danger"
                                                method="POST"
                                                action="{{ route('tujuan.destroy', $data->id) }}"
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
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                {{  $tujuans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
