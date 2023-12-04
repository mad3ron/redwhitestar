<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('biss.index') }}" class="intro-y text-lg font-medium mr-auto">
                Inventory Bus
            </a>
        </div>
        <!-- BEGIN: Wizard Layout -->
        <div class="intro-y box py-10 sm:py-20 mt-5">
            <div class="px-5 sm:px-10 ">
                <form method="POST" action="{{ route('biss.update', $bis->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-2">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Body</label>
                            <input id="nobody" type="text" name="nobody" value="{{ $bis->nobody }}" class="form-control @error('nobody') is-invalid @enderror" minlength="2" required>
                            @error('nobody')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Polisi</label>
                            <input id="nopolisi" type="text" name="nopolisi" class="form-control" value="{{ $bis->nopolisi }}" minlength="2" required>

                            @error('nopolisi')
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Chassis</label>
                            <input id="nochassis" type="text" name="nochassis" class="form-control" value="{{ $bis->nochassis }}" minlength="2" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Nomor Mesin</label>
                            <input id="nomesin" type="text" name="nomesin" class="form-control" value="{{ $bis->nomesin }}" minlength="2" required>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Pool</label>
                            <select id="pool_id" name="pool_id" data-search="true" class="tom-select w-full">
                                <option value="">Select Pool</option>
                                @foreach ($pools as $pool)
                                    <option value="{{ $pool->id }}" {{ $bis->pool_id == $pool->id ? 'selected' : '' }}>
                                        {{ $pool->nama_pool }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Rute</label>
                            <select id="rute_id" name="rute_id" data-search="true" class="tom-select w-full">
                                <option value="">Select Rute</option>
                                @foreach ($rutes as $rute)
                                    <option value="{{ $rute->id }}" {{ $bis->rute_id == $rute->id ? 'selected' : '' }}>
                                        {{ $rute->koderute }} - {{ $rute->namarute }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-8">
                            <div class="sm:grid grid-cols-4 gap-4">
                                <div class="font-medium mt-2 sm:mt-2">
                                    <div id="merk" class="input-group-text">Merk</div>
                                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ $bis->merk }}" required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="tahun" class="input-group-text">Tahun</div>
                                    <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ $bis->tahun }}" required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="jenis" class="input-group-text">Jenis</div>
                                    <select id="jenis" name="jenis" data-search="true" class="tom-select w-full" required>
                                        <option value="">Select Type</option>
                                        <option value="SUPER EXECUTIVE" {{ $bis->jenis == 'SUPER EXECUTIVE' ? 'selected' : '' }}>SUPER EXECUTIVE</option>
                                        <option value="EXECUTIVE" {{ $bis->jenis == 'EXECUTIVE' ? 'selected' : '' }}>EXECUTIVE</option>
                                        <option value="AC BISNIS" {{ $bis->jenis == 'AC BISNIS' ? 'selected' : '' }}>AC BISNIS</option>
                                        <option value="AC EKONOMI" {{ $bis->jenis == 'AC EKONOMI' ? 'selected' : '' }}>AC EKONOMI</option>
                                    </select>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="seat" class="input-group-text">Seat</div>
                                    <select id="seat" name="seat" data-search="true" class="tom-select w-full" required>
                                        <option value="">Select Seat</option>
                                        <option value="Seat 39" {{ $bis->seat == 'Seat 39' ? 'selected' : '' }}>Seat 39</option>
                                        <option value="Seat 45" {{ $bis->seat == 'Seat 45' ? 'selected' : '' }}>Seat 45</option>
                                        <option value="Seat 47" {{ $bis->seat == 'Seat 47' ? 'selected' : '' }}>Seat 47</option>
                                        <option value="Seat 57" {{ $bis->seat == 'Seat 57' ? 'selected' : '' }}>Seat 57</option>
                                    </select>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="izintrayek" class="input-group-text">Nomor Izin Trayek</div>
                                    <input type="text" name="izintrayek" class="form-control @error('izintrayek') is-invalid @enderror" value="{{ $bis->izintrayek }}" required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="nomor_uji" class="input-group-text">Nomor Uji</div>
                                    <input type="text" name="nomor_uji" class="form-control @error('nomor_uji') is-invalid @enderror" value="{{ $bis->nomor_uji }}"  required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="kondisi" class="input-group-text">Kondisi</div>
                                    <select id="kondisi" name="kondisi" data-search="true" class="tom-select w-full" required>
                                        <option value="">Select kondisi</option>
                                            <option value="AKTIF" {{ $bis->kondisi  == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                                            <option value="NONAKTIF" {{ $bis->kondisi  == 'NONAKTIF' ? 'selected' : '' }}>NONAKTIF</option>
                                            <option value="LAKA" {{ $bis->kondisi  == 'LAKA' ? 'selected' : '' }}>LAKA</option>
                                            <option value="KARESORI" {{ $bis->kondisi  == 'KARESORI' ? 'selected' : '' }}>KARESORI</option>
                                            <option value="UPKIR" {{  $bis->kondisi  == 'UPKIR' ? 'selected' : '' }}>UPKIR</option>
                                    </select>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="rasio" class="input-group-text">Rasio BBM</div>
                                    <input id="rasio" type="number" name="rasio" class="form-control @error('rasio') is-invalid @enderror" value="{{ $bis->rasio }}" required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="tgl_stnk" class="input-group-text">Tgl Berlaku STNK</div>
                                    <input type="date" name="tgl_stnk" class="form-control @error('tgl_stnk') is-invalid @enderror" value="{{ $bis->tgl_stnk }}"  required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="tgl_stnk2" class="input-group-text">S/d Tanggal</div>
                                    <input type="date" name="tgl_stnk2" class="form-control @error('tgl_stnk2') is-invalid @enderror" value="{{ $bis->tgl_stnk2 }}"  required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="tgl_kir" class="input-group-text">Tgl Berlaku KIR</div>
                                    <input type="date" name="tgl_kir" class="form-control @error('tgl_kir') is-invalid @enderror" value="{{ $bis->tgl_kir }}"  required>
                                </div>
                                <div class="font-medium mt-5 sm:mt-2">
                                    <div id="tgl_kps" class="input-group-text">Tgl Berlaku KPS</div>
                                    <input type="date" name="tgl_kps" class="form-control @error('tgl_kps') is-invalid @enderror" value="{{ $bis->tgl_kps }}"  required>
                                </div>
                            </div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan" type="text" name="keterangan" class="form-control" value="{{ $bis->keterangan }}">
                        </div>
                        <!-- Button -->
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="mt-5 sm:mt-5">
                                <div class="col-span-12 2xl:col-span-6 mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('biss.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
