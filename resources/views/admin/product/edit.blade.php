<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('product.index') }}" class="font-medium text-base mr-auto">
                    Edit Product
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <form method="POST" action="{{ route('product.update', $product->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label">product</label>
                                <input id="name" name="name" type="text" value="{{ $product->name }}" class="form-control">
                            </div>
                            <!---Button-->
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-auto">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
