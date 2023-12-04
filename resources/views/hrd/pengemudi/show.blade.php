<x-app-layout>
    <div class="content">
        <div class="flex items-center mt-8">
            <a href="{{ route('pengemudi.index') }}" class="intro-y text-lg font-medium mr-auto">
                Rute Bus
            </a>
        </div>
        <!-- Tabel untuk menampilkan data pengemudi -->
        <div class="intro-y box mt-5">
            <div class="p-5">
                <div class="intro-y card">
                    <div class="card-body mt-8">
                        <h6 class="text-lg text-success font-medium leading-none mt-3">Data Pengemudi</h6>
                        <table class="intro-y table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nomor Pengemudi</th>
                                    <th>NIK</th>
                                    <th>Rute</th>
                                    <th>Tanggal KP</th>
                                    <th>No. SIM</th>
                                    <th>Jenis SIM</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $pengemudi->nopengemudi }}</td>
                                        <td>{{ $pengemudi->nik }}</td>
                                        <td>{{ $pengemudi->rute->koderute }} - {{ $pengemudi->rute->namarute }}</td>
                                        <td>{{ $pengemudi->tgl_kp }}</td>
                                        <td>{{ $pengemudi->nosim }}</td>
                                        <td>{{ $pengemudi->jenis_sim }}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
