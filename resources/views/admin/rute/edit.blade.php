<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('rute.index') }}" class="intro-y text-lg font-medium mr-auto">
                Rute Bus
            </a>
        </div>
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-10 sm:py-10 mt-5">
            <div class="px-5 sm:px-10 ">
                <form action="{{ route('rute.update', $rute->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-2">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Rute</label>
                            <input id="koderute" type="text" name="koderute" class="form-control @error('koderute') is-invalid @enderror" placeholder="Input koderute" value="{{ $rute->koderute }}" required>

                            @error('koderute')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">Data Sudah Ada</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nama Rute</label>
                            <input id="namarute" type="text" name="namarute" class="form-control @error('namarute') is-invalid @enderror" placeholder="Input namarute" value="{{$rute->namarute }}">

                            @error('namarute')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Jenis</label>
                            <select id="jenis" name="jenis" data-search="true" class="tom-select w-full">
                                <option value="">Select Jenis</option>
                                @foreach (App\Enums\TableJenis::cases() as $jenis)
                                    <option value="{{ $jenis->value }}" @if($rute->jenis == $jenis->value) selected @endif>{{ $jenis->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Std Rit</label>
                            <input id="stdrit" type="number" name="stdrit" class="form-control @error('stdrit') is-invalid @enderror" placeholder="Input stdrit" value="{{ $rute->stdrit }}">

                            @error('stdrit')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pool</label>
                            <select id="pool_id" name="pool_id" data-search="true" class="tom-select w-full">
                                <option value="">Select Pool</option>
                                @foreach ($pools as $pool)
                                    <option value="{{ $pool->id }}" @if($rute->pool_id == $pool->id) selected @endif>{{ $pool->nama_pool }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Product</label>
                            <select id="product_id" name="product_id" data-search="true" class="tom-select w-full">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if($rute->product_id == $product->id) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Status</label>
                            <select id="status" name="status" data-search="true" class="tom-select" required>
                                <option value="">Select Status</option>
                                <option value="Active" @if($rute->status == 'Active') selected @endif>Active</option>
                                <option value="Inactive" @if($rute->status == 'Inactive') selected @endif>Inactive</option>
                                <option value="Disable" @if($rute->status == 'Disable') selected @endif>Disable</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
