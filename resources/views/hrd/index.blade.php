<x-app-layout>
    <x-slot name="Header">
        
        <a href="{{ route('admin.categories.index') }}" class="intro-y text-lg font-medium mt-10">
            Categories
        </a>
       
    </x-slot>
    @if (session('message'))
        <div class="alert alert-outline-success alert-dismissible show flex items-center mb-2" role="alert"> <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> {{ session('message') }} <button type="button" class="btn-close" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button> </div>
     @endif
    <div class="grid grid-cols-12 gap-6 mt-5">
        
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-md mr-2">Add New Category</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="#" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
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
            <div class="hidden xl:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <form method="GET" action="/admin/category"> 
                        @csrf
                    <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    </form>
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                </div>
                <select id="is_visible" name="is_visible" class="w-56 xl:w-auto form-select box ml-2">
                    {{-- @foreach (App\Enums\TableActive::cases() as $is_visible)
                        <option value="{{ $is_visible->value }}">{{ $is_visible->name }}</option>
                    @endforeach --}}
                </select>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        {{-- <th class="whitespace-nowrap">
                            <input class="form-check-input" type="checkbox">
                        </th> --}}
                        <th class="whitespace-nowrap">No.</th>
                        <th class="whitespace-nowrap">Nama Katagory</th>
                        <th class="whitespace-nowrap">Slug</th>
                        <th class="whitespace-nowrap">Image</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)

                        <tr class="intro-x">
                            {{-- <td class="w-10">
                                <input class="form-check-input" type="checkbox">
                            </td> --}}
                            <td>{{ $category->id }}</td>
                            <td class="text-sm whitespace-nowrap mt-0.5">{{ $category->name }}</td>
                            <td class="text-sm whitespace-nowrap mt-0.5">{{ $category->slug }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-12 w-12 rounded-md"
                                        src="{{ Storage::url($category->image) }}">
                                        <img class="h-12 w-12 rounded-md"
                                        src="{{ $path = Storage::path('public\storage\public\categories'.$category->image); }}">
                                </div>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="flex items-center text-primary whitespace-nowrap mr-5" href="javascript:;"> <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit </a>

                                    <form
                                        class="flex items-center text-danger"
                                        method="POST"
                                        action="{{ route('admin.categories.destroy', $category->id) }}"
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
            <div class="p-2 m-2">
                {{ $categories->links() }}
            </div>
        </div>

        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <ul class="pagination">
                    <li class="page-item {{ ($category->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $category->url(1) }}">
                            <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item {{ ($category->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $category->previousPageUrl() }}">
                            <i class="w-4 h-4" data-lucide="chevron-left"></i>
                        </a>
                    </li>
                    @if($category->currentPage() > 2)
                        <li class="page-item">
                            <a class="page-link" href="#">...</a>
                        </li>
                    @endif
                    @for($i = $category->currentPage() - 1; $i <= $category->currentPage() + 1; $i++)
                        @if($i > 0 && $i <= $category->lastPage())
                            <li class="page-item {{ ($i == $category->currentPage()) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $category->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor

                    @if($category->currentPage() < $category->lastPage() - 1)
                        <li class="page-item">
                            <a class="page-link" href="#">...</a>
                        </li>
                    @endif

                    <li class="page-item {{ ($category->currentPage() == $category->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $category->nextPageUrl() }}">
                            <i class="w-4 h-4" data-lucide="chevron-right"></i>
                        </a>
                    </li>

                    <li class="page-item {{ ($category->currentPage() == $category->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $category->url($category->lastPage()) }}">
                            <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0" onchange="window.location.href = this.value">
                @foreach([10, 25, 50, 100] as $perPage)
                    <option value="{{ $category->url(1) . '&per_page=' . $perPage }}" {{ ($perPage == $category->perPage()) ? 'selected' : '' }}>
                        {{ $perPage }}
                    </option>
                @endforeach
            </select>
        </div> --}}
    </div>

</x-app-layout>