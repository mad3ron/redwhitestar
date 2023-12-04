<x-app-layout>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: User Applikasi -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            User Applikasi
                        </h2>
                        <a href="{{ route('userapps.index') }}" class="ml-auto flex items-center text-primary">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                        <a href="{{ route('userapps.create') }}" class="btn btn-primary shadow-md mr-2">New Users</a>
                    </div>
                </div>
                <!--End -->
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">No.</th>
                            <th class="whitespace-nowrap">User Id</th>
                            <th class="whitespace-nowrap">Nama User</th>
                            <th class="whitespace-nowrap">App Id</th>
                            <th class="whitespace-nowrap">Nama User Applikasi</th>
                            <th class="whitespace-nowrap">password</th>
                            <th class="whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userapps as $userApp)
                            <tr class="intro-x">
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userapps->firstItem() + $loop->index }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userApp->user_id }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userApp->name }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userApp->nokar_id }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userApp->nama }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userApp->password }}</td>
                                <td class="text-sm whitespace-nowrap mt-0.5">{{ $userApp->status }}</td>
                                <td class="table-report__action">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('userapps.edit', $userApp->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5">
                                            <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                        </a>
                                        <form class="flex items-center text-danger" method="POST" action="{{ route('userapps.destroy', $userApp->id) }}" onsubmit="return confirm('Are you sure?');">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
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
            <div class="p-2 m-2">
                {{ $userapps->appends(['search' => $search, 'perpage' => $perpage])->links() }}
            </div>
        </div>
</x-app-layout>
