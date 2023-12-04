<x-app-layout>
    <div class="mt-10">
        <a href="{{ route('armada.index') }}" class="intro-y text-lg font-medium mt-10">
            Jenis Armada
        </a>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ route('armada.create') }}" class="btn btn-primary shadow-md mr-2">Add Jenis Armada </a>
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
                    Showing {{ $armadas->firstItem() }} to {{ $armadas->lastItem() }} of {{ $armadas->total() }} entries
                </div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <form method="GET" action="{{ route('armada.index') }}">
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
                            <th class="whitespace-nowrap">Photo</th>
                            <th class="whitespace-nowrap">Jenis Armada</th>
                            <th class="whitespace-nowrap">Seat</th>
                            <th class="whitespace-nowrap">Fasilitas</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($armadas as $data)
                            <tr class="intro-x">
                                <td class="text-sm whitespace-nowrap mt-0.5">
                                    <img class="w-10 h-10 image-fit zoom-in rounded-full" src="{{ asset('storage/' . $data->photo) }}" alt="{{ $data->photo }}">
                                </td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->jenis_armada}}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->seat }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $data->descripsi }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('armada.edit', $data->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5"
                                            href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                            <form
                                                class="flex items-center text-danger"
                                                method="POST"
                                                action="{{ route('armada.destroy', $data->id) }}"
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
                {{-- {{  $armadas->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
