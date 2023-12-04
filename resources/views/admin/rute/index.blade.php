<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('rute.index') }}" class="intro-y text-lg font-medium mt-10">
            Data List Rute
        </a>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('rute.create') }}" class="btn btn-primary shadow-md mr-2">Add New Bus</a>
                <div class="dropdown">
                    <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="{{ route('rutes.view-pdf') }}" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
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
                    Showing {{ $rutes->firstItem() }} to {{ $rutes->lastItem() }} of {{ $rutes->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <form method="GET" action="{{ route('rute.index') }}">
                            @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                        </form>
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">No.</th>
                            <th class="whitespace-nowrap">Rute</th>
                            <th class="whitespace-nowrap">Nama Rute</th>
                            <th class="whitespace-nowrap">Jenis</th>
                            <th class="whitespace-nowrap">Str Rit</th>
                            <th class="whitespace-nowrap">Pool</th>
                            <th class="whitespace-nowrap">Product</th>
                            <th class="whitespace-nowrap">Status</th>
                            <th class="text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rutes as $rute)
                            <tr class="intro-x">
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->id }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->koderute }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->namarute }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->jenis }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->stdrit }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->pools->nama_pool}}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $rute->products->name }}</td>
                                <td class="w-40">
                                    @if ($rute->status == 'Active')
                                        <label class="flex items-left justify-left text-success">Active</label>
                                    @elseif ($rute->status =='Inactive')
                                        <label class="flex items-left justify-left text-danger">Inactive</label>
                                    @elseif ($rute->status =='Disable')
                                        <label class="flex items-left justify-left text-warning">Disable</label>
                                    @endif
                                </td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('rute.edit', $rute->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        <form
                                            class="flex items-center text-danger"
                                            method="POST"
                                            action="{{ route('rute.destroy', $rute->id) }}"
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
        {{-- {{  $rutes->links() }} --}}
        </div>
    </div>
</x-app-layout>
