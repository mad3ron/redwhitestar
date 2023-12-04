<x-app-layout>
    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">
            Role Information
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary shadow-md mr-2">Add New Roles</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="{{ route('admin.roles.index') }}">
                            @csrf
                        <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
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
                        <th class="whitespace-nowrap">Role Name</th>
                        <th class="text-center whitespace-nowrap">Guard</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr class="intro-x">
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $role->name }}</a>
                        </td>
                        <td class="text-center">{{ $role->guard_name }}</td>

                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ route('admin.roles.edit', $role->id) }}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>

                                <a class="flex items-center text-danger" href="{{ route('admin.roles.destroy', $role->id) }}" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            </form>
                            </div>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- {{  $roles->links() }} --}}

    </div>

</x-app-layout>
