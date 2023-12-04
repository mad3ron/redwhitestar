<x-app-layout>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Personal Information -->
        <div class="intro-y box mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <a href="{{ route('biodatas.index') }}" class="font-medium text-base mr-auto">
                    Edit biodata
                </a>
            </div>

            <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <form method="POST" action="{{ route('biodatas.update', $biodata->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label">biodata</label>
                                <input id="name" name="name" type="text" value="{{ $biodata->name }}" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Nama biodata</label>
                                <input id="namabiodata" type="text" name="namabiodata" value="{{ $biodata->namabiodata }}" class="form-control" placeholder="Input namabiodata" @error('namabiodata') is-invalid @enderror" >
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Std Rit</label>
                                <input id="stdrit" type="number" name="stdrit" value="{{ $biodata->stdrit }}" class="form-control" placeholder="Input stdrit" @error('stdrit') is-invalid @enderror" >
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Pool</label>
                                <select id="pool_id" name="pool_id" data-search="true" class="tom-select w-full">
                                    @foreach ($pools as $pool)
                                        <option value="{{ $pool->id }}"  @selected($pool->id == $biodata->pool_id)>{{ $pool->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Product</label>
                                <select id="product_id" name="product_id" data-search="true" class="tom-select w-full">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" @selected($product->id == $biodata->product_id)>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" data-search="true" class="tom-select w-full">
                                    @foreach (App\Enums\TableActive::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($status->name == $biodata->status)>{{ $status->name }}</option>
                                    @endforeach
                                </select>
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
