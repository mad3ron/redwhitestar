<x-app-layout>.
    <a href="{{ route('posisis.index') }}" class="intro-y text-lg font-medium mt-10">
        Data Pos Checker
    </a>
    @if (session('success'))
        <!-- BEGIN: Notification Content -->
        <div id="basic-non-sticky-notification-content" class="toastify-content flex">
            <div class="font-medium">{{ session('success') }}</div>
            <a class="font-medium text-primary dark:text-slate-400 mt-1 sm:mt-0 sm:ml-40" href="{{ route('posisis.index') }}">Review Changes</a>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('posisis.create') }}" class="btn btn-primary shadow-md mr-2">Add New Pos</a>
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
                            <a href="#" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Grafik </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">
                Showing {{ $posisis->firstItem() }} to {{ $posisis->lastItem() }} of {{ $posisis->total() }} entries
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('posisis.index') }}">
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
                        <th class="text-center whitespace-nowrap">Posisi</th>
                        <th class="text-center whitespace-nowrap">Kode Posisi</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posisis as $posisi)
                    <tr class="intro-x">
                        <td>{{ $posisi->id }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $posisi->name }}</td>
                        <td class="text-sm whitespace-nowrap mt-0.5">{{ $posisi->kodeposisi }}</td>
                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('posisis.edit', $posisi->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                <form
                                    class="flex items-center text-danger"
                                    method="POST"
                                    action="{{ route('posisis.destroy', $posisi->id) }}"
                                    onsubmit="return confirm('Are you sure?');"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        {{  $posisis->links() }}
        </div>
</x-app-layout>

