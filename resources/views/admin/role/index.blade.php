<x-app-layout>
    {{-- @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif --}}
    @if (session('success'))
    <!-- BEGIN: Notification Content -->
    <div id="basic-non-sticky-notification-content" class="toastify-content flex">
        <div class="font-medium">{{ session('success') }}</div>
        <a class="font-medium text-primary dark:text-slate-400 mt-1 sm:mt-0 sm:ml-40" href="">Review Changes</a>
    </div>
    <!-- END: Notification Content -->
@endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('roles.create') }}" class="btn btn-primary shadow-md mr-2">Add New Users</a>
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
                            {{-- <a href="{{ route('users.dashboard') }}" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Grafik </a> --}}
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('roles.index') }}">
                         @csrf
                        <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    </form>
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">No.</th>
                    <th class="whitespace-nowrap">Roles</th>
                    <th class="whitespace-nowrap">Permissions</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($role as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                                <span class="badge badge-primary">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ route('roles.edit', $role->id) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <form
                                class="flex items-center text-danger"
                                method="POST"
                                action="{{ route('roles.destroy', $role->id) }}"
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

        {{-- {{ $role->links() }} --}}

</x-app-layout>



