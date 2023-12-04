<x-app-layout>.
    <a href="{{ route('users.index') }}" class="intro-y text-lg font-medium mt-10">
        Data List Users
    </a>
    @if (session('success'))
        <!-- BEGIN: Notification Content -->
        <div id="basic-non-sticky-notification-content" class="toastify-content flex">
            <div class="font-medium">{{ session('success') }}</div>
            <a class="font-medium text-primary dark:text-slate-400 mt-1 sm:mt-0 sm:ml-40" href="{{ route('users.index') }}">Review Changes</a>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('users.create') }}" class="btn btn-primary shadow-md mr-2">Add New Users</a>
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
                            {{-- <a href="{{ route('export-users') }}" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a> --}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('users.index') }}">
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
                        <th class="whitespace-nowrap">User Name</th>
                        <th class="text-center whitespace-nowrap">Email</th>
                        <th class="text-center whitespace-nowrap">Role</th>
                        <th class="text-center whitespace-nowrap">Status</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="intro-x">
                        <td>{{ $user->id }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="font-medium whitespace-nowrap">{{ $user->name }}</a>

                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $user->username }}</div>
                        </td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $user->role_id}}</a>
                            @foreach($user->roles as $role)
                                @if($user->hasRole($role->name))
                                    <span class="badge badge-secondary">{{ $role->name }}</span>
                                @endif
                            @endforeach
                        </td>
                        <td class="w-40">
                            @if ($user->status == 'Active')
                                <label class="flex items-center justify-center text-success">Active</label>
                            @elseif ($user->status =='Inactive')
                                <label class="flex items-center justify-center text-warning">Inactive</label>
                            @elseif ($user->status =='Disable')
                                <label class="flex items-center justify-center text-danger">Disable</label>
                            @else
                            @endif
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                {{-- <a class="flex items-center mr-3" href="{{ route('roles.edit', $user->id) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Role </a> --}}
                                <a class="flex items-center mr-5" href="{{ route('users.edit', $user->id) }}"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                <form
                                    class="flex items-center text-danger"
                                    method="POST"
                                    action="{{ route('users.destroy', $user->id) }}"
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
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{  $users->links() }}
        </div>
    </div>
</x-app-layout>

