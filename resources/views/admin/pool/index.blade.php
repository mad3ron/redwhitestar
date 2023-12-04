<x-app-layout>
    <a href="{{ route('pool.index') }}" class="intro-y text-lg font-medium mt-10">
        Data List Pool
    </a>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('pool.create') }}" class="btn btn-primary shadow-md mr-2">Add New Pool</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">
                Showing {{ $pools->firstItem() }} to {{ $pools->lastItem() }} of {{ $pools->total() }} entries
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('pool.index') }}">
                        @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    </form>
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">No.</th>
                        <th class="whitespace-nowrap">Pool</th>
                        <th class="whitespace-nowrap">Alamat</th>
                        <th class="whitespace-nowrap">Phone</th>
                        <th class="whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pools as $pool)
                        <tr class="intro-x">
                            <td class="text-sm whitespace-nowrap mt-0.5">{{ $pool->id }}</td>
                            <td class="text-sm whitespace-nowrap mt-0.5">{{ $pool->nama_pool }}</td>
                            <td class="text-sm whitespace-nowrap mt-0.5">{{ $pool->alamat }}</td>
                            <td class="text-sm whitespace-nowrap mt-0.5">{{ $pool->phone }}</td>
                            <td class="w-20">
                                @if ($pool->status == 'Active')
                                    <label class="flex items-center justify-left text-success">Active</label>
                                @elseif ($pool->status =='Inactive')
                                    <label class="flex items-center justify-left text-danger">Inactive</label>
                                @elseif ($pool->status =='Disable')
                                    <label class="flex items-center justify-left text-warning">Disable</label>
                                @endif
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('pool.edit', $pool->id) }}"
                                        class="flex items-center mr-2"><i data-lucide="check-square" class="w-4 h-4 mr-1"></i>Edit</a>
                                    <form
                                        class="flex items-center text-danger"
                                        method="POST"
                                        action="{{ route('pool.destroy', $pool->id) }}"
                                        onsubmit="return confirm('Are you sure?');">
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
        {{  $pools->links() }}
    </div>
    </div>
</x-app-layout>
