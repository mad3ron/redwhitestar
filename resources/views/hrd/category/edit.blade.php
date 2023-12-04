<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('admin.categories.index') }}" class="intro-y text-lg font-medium mr-auto">
                Create Category
            </a>
        </div>
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Display Information
                </h2>
            </div>
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Name</label>
                                    <input id="name" type="text" name="name" class="form-control" placeholder="Input name" value="{{ $category->name }}">
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Photo</label>
                                    <div class="w-full m-2 p-2">
                                        <img class="h-32 w-32" src="{{ Storage::url($category->image) }}">
                                    </div>
                                    <input type="file" id="image" name="image" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
