<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Booking Bus Pariwisata
        </h2>
        {{-- <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
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
        </div> --}}
    </div>
    <div class="intro-y grid grid-cols-12 gap-4 mt-5">
        <!-- BEGIN: Item List -->
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Inline Form
                    </h2>
                </div>
                <div id="inline-form" class="p-5">
                    <div class="preview">
                        <form method="GET" action="{{ route('booking.index') }}">
                            @csrf
                            <div class="grid grid-cols-8 gap-2">
                                <input type="date" id="tanggal" class="form-control col-span-3" data-single-mode="true">
                                {{-- <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#new-order-modal" class="btn btn-primary col-span-2 shadow-md mr-2">Booking</a> --}}
                                <input type="text" class="form-control col-span-3" placeholder="Search item...">
                                <button type="submit" class="btn btn-primary col-span-2"> <i data-lucide="Search" class="w-4 h-4 ml-2"></i> Search</button>
                            </form>
                            </div>

                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-inline-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                            <pre id="copy-inline-form" class="source-preview"> <code class="html"> HTMLOpenTagdiv class=&quot;grid grid-cols-12 gap-2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 1&quot; aria-label=&quot;default input inline 1&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 2&quot; aria-label=&quot;default input inline 2&quot;HTMLCloseTag HTMLOpenTaginput type=&quot;text&quot; class=&quot;form-control col-span-4&quot; placeholder=&quot;Input inline 3&quot; aria-label=&quot;default input inline 3&quot;HTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class="intro-y box mt-5 ">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        List Booking Bis
                    </h2>
                </div>
                <div id="inline-form" class="p-5">
                    <div class="intro-y col-span-12 overflow-auto">
                        <table class="table table-report">
                            <thead>
                                <tr>
                                    <th class="uppercase text-xs whitespace-nowrap">Jenis Bis</th>
                                    <th class="uppercase text-xs">Nomor Body/Polis</th>
                                    <th class="uppercase text-xs">Nomor Booking</th>
                                    <th class="uppercase text-xs">Tanggal</th>
                                    <th class="uppercase text-xs">Nama Konsumen</th>
                                    <th class="uppercase text-xs">Tujuan</th>
                                    <th class="uppercase text-xs">Keterangan</th>
                                    <th class="uppercase text-xs">User</th>
                                    <th class="uppercase text-xs">Booking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $data)
                                    <tr class="cursor-pointer zoom-in">
                                        <td class="uppercase text-xs">{{ $data->status_harga }}</td>
                                        <td class="w-20">
                                            <span class="uppercase text-xs whitespace-nowrap">{{ $data->nobody }}</span>
                                            <div class="uppercase text-xs">{{ $data->nopolisi }}</div>
                                        </td>
                                        <td class="uppercase text-xs">{{ $data->nobooking }}</td>
                                        <td class="uppercase text-xs">{{ $data->tanggal }}</td>
                                        <td class="uppercase text-xs">{{ $data->nama_konsumen }}</td>
                                        <td class="uppercase text-xs">{{ $data->tujuan }}</td>
                                        <td class="uppercase text-xs">{{ $data->keterangan }}</td>
                                        <td class="uppercase text-xs">{{ $data->name }}</td>
                                        <td>
                                            <a href="{{ route('booking.create', ['bis_id' => $data->bis_id, 'nobody' => $data->nobody]) }}" class="btn btn-primary shadow-md mr-2">Booking</a>


                                            {{-- <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#new-order-modal" class="btn btn-primary col-span-2 shadow-md mr-2">Booking</a> --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                        <!-- BEGIN: Pagination -->
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                            {{ $bookings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Item List -->

        <!-- BEGIN: Ticket -->
        {{-- <div class="col-span-12 lg:col-span-4">
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
        </div> --}}
        <!-- END: Ticket -->
    </div>
    <!-- BEGIN: New Order Modal -->
    <div id="new-order-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Input Booking
                    </h2>
                </div>
                <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="nobooking" class="form-label">Nomor Booking</label>
                            <input type="text" name="nobooking" id="nobooking" class="form-control" readonly>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control col-span-3" data-single-mode="true">
                                @error('tanggal')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="nama_konsumen" class="form-label">Nama Konsumen</label>
                            <input id="nama_konsumen" type="text" name="nama_konsumen" value="{{ old('nama_konsumen') }}" class="form-control @error('nama_konsumen') text-red-700 @enderror" placeholder="Input Nama Konsumen" required>
                                @error('nama_konsumen')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                        </div>
                        {{-- <td class="uppercase text-xs">
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label class="form-label">Nomor Body</label>
                                <input id="bis_id" type="text" name="bis_id" value="{{ $data->bisId }}" class="form-control @error('bis_id') text-red-700 @enderror" placeholder="Input No Body">
                                @error('bis_id')
                                    <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </td> --}}
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <select id="tujuan_id" name="tujuan_id" class="tom-select select2" data-tags="true" required>
                                <option value="">{{ __('Select Tujuan') }}</option>
                                @if(isset($tujuans) && count($tujuans) > 0)
                                    @foreach($tujuans as $tujuan)
                                        <option value="{{ $tujuan->id }}" {{ old('tujuan_id') == $tujuan->id ? 'selected' : '' }}>
                                            {{ $tujuan->tujuan }} - {{ $tujuan->harga_dasar }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('tujuan_id')
                                <div class="text-theme-6 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Phone</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') text-red-700 @enderror" placeholder="Input phone" minlength="2" required>
                            @error('phone')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <label class="form-label">Keterangan</label>
                            <input id="keterangan" type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') text-red-700 @enderror" placeholder="Input Keterangan">
                            @error('keterangan')
                                <div class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-12">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                            <button type="button" id="saveBooking" class="btn btn-primary w-32">Save</button>
                        </div>
                    </div>
                </form>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</x-app-layout>

