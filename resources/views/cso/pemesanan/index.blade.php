<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Booking Bus Pariwisata
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#new-order-modal" class="btn btn-primary shadow-md mr-2">Booking</a>
            <div class="pos-dropdown dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="chevron-down"></i> </span>
                </button>
                <div class="pos-dropdown__dropdown-menu dropdown-menu">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> <span class="truncate">INV-0206020 - Nicolas Cage</span> </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> <span class="truncate">INV-0206022 - Arnold Schwarzenegger</span> </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> <span class="truncate">INV-0206021 - Denzel Washington</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Item List -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Inline Form
                    </h2>
                </div>
                <div id="inline-form" class="p-5">
                    <div class="preview">
                        <form method="GET" action="{{ route('pemesanan.index') }}">
                            @csrf
                            <div class="grid grid-cols-12 gap-2">
                                <input type="date" id="tanggal" class="form-control col-span-4" data-single-mode="true">
                                <input type="text" class="form-control col-span-4" placeholder="Search item...">
                                <button type="submit" class="btn btn-primary col-span-4"> <i data-lucide="Search" class="w-4 h-4 ml-2"></i> Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        List tabel
                    </h2>
                </div>
                <div id="inline-form" class="p-5">
                    <div class="intro-y col-span-12 overflow-auto">
                        <table class="table table-report">
                            <thead>
                                <tr>
                                    <th class="uppercase text-xs whitespace-nowrap">Nama.Pemesan Phone</th>
                                    <th class="uppercase text-xs">Alamat</th>
                                    <th class="uppercase text-xs">Tujuan / Pemakaian</th>
                                    <th class="uppercase text-xs">Tanggal Brkt/Pulang</th>
                                    <th class="uppercase text-xs">Durasi Hari</th>
                                    <th class="uppercase text-xs">Armada</th>
                                    <th class="uppercase text-xs">Harga</th>
                                    <th class="uppercase text-xs">Jml Bis</th>
                                    <th class="uppercase text-xs">Biaya Jemput</th>
                                    <th class="uppercase text-xs">Total Harga</th>
                                    <th class="uppercase text-xs">Jam Jemput</th>
                                    <th class="uppercase text-xs">Pool</th>
                                    <th class="uppercase text-xs">Status</th>
                                    <th class="uppercase text-xs">User</th>
                                    <th class="uppercase text-xs">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanans as $data)
                                    <tr class="intro-x">
                                        <td class="w-20">
                                            <a href="{{ route('pembayaran.show', ['nomorPembayaran' => $data->id]) }}" class="uppercase text-xs whitespace-nowrap mt-0.5"><b>{{ $data->nama_pemesan }}</b></a>

                                            {{-- <a href="{{ route('pembayaran.show', ['pembayarans' => $data->id]) }}" class="uppercase text-xs whitespace-nowrap">{{ $data->nama_pemesan }}</a> --}}
                                            <div class="uppercase text-xs">{{ $data->phone }}</div>
                                        </td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->alamat }}</td>
                                        <td class="w-20">
                                            <span class="uppercase text-xs whitespace-nowrap">{{ $data->tujuans->tujuan }}</span>
                                            <div class="uppercase text-xs">{{ $data->tujuans->pemakaian }}</div>
                                        </td>
                                        <td class="w-20">
                                            <a href="" class="uppercase text-xs">{{ date('d/m/Y', strtotime($data->tgl_brkt)) }}</a>
                                            <div class="uppercase text-xs">{{ date('d/m/Y', strtotime($data->tgl_pulang)) }}</div>
                                        </td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->durasi_hari }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->armadas->jenis_armada }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->harga, 0, ',', '.') }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->jml_bis }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->biaya_jemput, 0, ',', '.') }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ number_format($data->total_harga, 0, ',', '.') }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->jam_jemput }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->pools->nama_pool }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->status }}</td>
                                        <td class="uppercase text-xs whitespace-nowrap">{{ $data->user->name }}</td>
                                        <td class="table-report__action">
                                            <div class="flex justify-center items-center">

                                                <a href="{{ route('pemesanan.edit', $data->id) }}" class="flex items-center text-xs text-primary whitespace-nowrap mr-5">
                                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                                </a>
                                                @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin'))
                                                <form class="flex items-center text-xs text-danger"
                                                    method="POST"
                                                    action="{{ route('pemesanan.destroy', $data->id) }}" data-tw-toggle="modal"
                                                    data-tw-target="#delete-confirmation-modal">
                                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete</button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Item List -->
        <!-- BEGIN: Ticket -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <ul class="nav nav-pills" role="tablist">
                        <li id="ticket-tab" class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="true" > Ticket </button>
                        </li>
                        <li id="details-tab" class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false" > Details </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="ticket" class="tab-pane active" role="tabpanel" aria-labelledby="ticket-tab">
                    <div class="box p-2 mt-5">
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                            <div class="max-w-[50%] truncate mr-1">Crispy Mushroom</div>
                            <div class="text-slate-500">x 1</div>
                            <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i>
                            <div class="ml-auto font-medium">$39</div>
                        </a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                            <div class="max-w-[50%] truncate mr-1">Pocari</div>
                            <div class="text-slate-500">x 1</div>
                            <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i>
                            <div class="ml-auto font-medium">$34</div>
                        </a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                            <div class="max-w-[50%] truncate mr-1">Milkshake</div>
                            <div class="text-slate-500">x 1</div>
                            <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i>
                            <div class="ml-auto font-medium">$46</div>
                        </a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                            <div class="max-w-[50%] truncate mr-1">Ultimate Burger</div>
                            <div class="text-slate-500">x 1</div>
                            <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i>
                            <div class="ml-auto font-medium">$65</div>
                        </a>
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                            <div class="max-w-[50%] truncate mr-1">Curry Penne and Cheese</div>
                            <div class="text-slate-500">x 1</div>
                            <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i>
                            <div class="ml-auto font-medium">$90</div>
                        </a>
                    </div>
                    <div class="box flex p-5 mt-5">
                        <input type="text" class="form-control py-3 px-4 w-full bg-slate-100 border-slate-200/60 pr-10" placeholder="Use coupon code...">
                        <button class="btn btn-primary ml-2">Apply</button>
                    </div>
                    <div class="box p-5 mt-5">
                        <div class="flex">
                            <div class="mr-auto">Subtotal</div>
                            <div class="font-medium">$250</div>
                        </div>
                        <div class="flex mt-4">
                            <div class="mr-auto">Discount</div>
                            <div class="font-medium text-danger">-$20</div>
                        </div>
                        <div class="flex mt-4">
                            <div class="mr-auto">Tax</div>
                            <div class="font-medium">15%</div>
                        </div>
                        <div class="flex mt-4 pt-4 border-t border-slate-200/60 dark:border-darkmode-400">
                            <div class="mr-auto font-medium text-base">Total Charge</div>
                            <div class="font-medium text-base">$220</div>
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <button class="btn w-32 border-slate-300 dark:border-darkmode-400 text-slate-500">Clear Items</button>
                        <button class="btn btn-primary w-32 shadow-md ml-auto">Charge</button>
                    </div>
                </div>
                <div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details-tab">
                    <div class="box p-5 mt-5">
                        <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-5">
                            <div>
                                <div class="text-slate-500">Time</div>
                                <div class="mt-1">02/06/20 02:10 PM</div>
                            </div>
                            <i data-lucide="clock" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                        <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 py-5">
                            <div>
                                <div class="text-slate-500">Customer</div>
                                <div class="mt-1">Robert De Niro</div>
                            </div>
                            <i data-lucide="user" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                        <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 py-5">
                            <div>
                                <div class="text-slate-500">People</div>
                                <div class="mt-1">3</div>
                            </div>
                            <i data-lucide="users" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                        <div class="flex items-center pt-5">
                            <div>
                                <div class="text-slate-500">Table</div>
                                <div class="mt-1">21</div>
                            </div>
                            <i data-lucide="mic" class="w-4 h-4 text-slate-500 ml-auto"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Ticket -->
    </div>
    <!-- BEGIN: New Order Modal -->
    <div id="new-order-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Tambah Booking
                    </h2>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="pos-form-1" class="form-label">Name</label>
                        <input id="pos-form-1" type="text" class="form-control flex-1" placeholder="Customer name">
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-2" class="form-label">Table</label>
                        <input id="pos-form-2" type="text" class="form-control flex-1" placeholder="Customer table">
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-3" class="form-label">Number of People</label>
                        <input id="pos-form-3" type="text" class="form-control flex-1" placeholder="People">
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-32">Create Ticket</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: New Order Modal -->
    <!-- BEGIN: Add Item Modal -->
    <div id="add-item-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Crispy Mushroom
                    </h2>
                </div>
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="pos-form-4" class="form-label">Quantity</label>
                        <div class="flex mt-2 flex-1">
                            <button type="button" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 mr-1">-</button>
                            <input id="pos-form-4" type="text" class="form-control w-24 text-center" placeholder="Item quantity" value="2">
                            <button type="button" class="btn w-12 border-slate-200 bg-slate-100 dark:bg-darkmode-700 dark:border-darkmode-500 text-slate-500 ml-1">+</button>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-5" class="form-label">Notes</label>
                        <textarea id="pos-form-5" class="form-control w-full mt-2" placeholder="Item notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button type="button" class="btn btn-primary w-24">Add Item</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Gunakan jQuery atau JavaScript murni
        $(document).ready(function () {
            // Menggunakan jQuery
            $('#tanggal').val(getFormattedDate());

            // Menggunakan JavaScript murni
            // document.getElementById('tanggal').value = getFormattedDate();
        });

        // Fungsi untuk mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        function getFormattedDate() {
            const now = new Date();
            const year = now.getFullYear();
            const month = ('0' + (now.getMonth() + 1)).slice(-2);
            const day = ('0' + now.getDate()).slice(-2);
            return `${year}-${month}-${day}`;
        }
    </script>
</x-app-layout>
