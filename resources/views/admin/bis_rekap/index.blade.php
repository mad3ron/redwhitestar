<x-app-layout>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Posisi Armada -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Posisi Armada
                        </h2>
                        <a href="{{ route('bisrekaps.index') }}" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                        </div>
                                    </div>
                                    {{-- <div class="text-3xl font-medium leading-8 mt-6">{{ $totalBis }}</div> --}}
                                    <div class="text-base text-slate-500 mt-1">Bis Ada : {{ $totalBis }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="credit-card" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="Persentasi Bis RKJ">  %<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                        </div>
                                    </div>
                                    {{-- <div class="text-3xl font-medium leading-8 mt-6">{{ $rkjBuses }}</div> --}}
                                    <div class="text-base text-slate-500 mt-1">Bis RKJ</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="monitor" class="report-box__icon text-warning"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                        </div>
                                    </div>
                                    {{-- <div class="text-3xl font-medium leading-8 mt-6">{{ $rgBuses }}</div> --}}
                                    <div class="text-base text-slate-500 mt-1">Bis RG</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="user" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                        </div>
                                    </div>
                                    {{-- <div class="text-3xl font-medium leading-8 mt-6">{{ $rktBuses }}</div> --}}
                                    <div class="text-base text-slate-500 mt-1">Bis RKT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BEGIN: Rekapitulasi Bis -->
                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            {{-- Rekapitulasi Inventaris Bis : {{ $totalBis }} --}}
                        </h2>
                        <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                            <div class="w-56 relative text-slate-500">
                                <form method="GET" action="{{ route('bisrekaps.index') }}">
                                    @csrf
                                    <input type="text" name="search" class="form-control w-56 box pr-10" placeholder="Search...">

                                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                                </form>
                            </div>
                        </div>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <form id="export-pdf" method="GET" action="#" target="_blank">
                                @csrf
                                <input type="hidden" name="search" value="{{ request()->input('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Export PDF
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                        <table class="table table-report sm:mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">No.Urt</th>
                                    <th class="whitespace-nowrap">Pool</th>
                                    <th class="text-left whitespace-nowrap">Kode Rute</th>
                                    <th class="text-left whitespace-nowrap">Nama Rute</th>
                                    <th class="text-left whitespace-nowrap">Bis Ada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr class="intro-x">
                                        <td class="text-left">{{ $results->firstItem() + $loop->index }}</td>
                                        <td class="text-left">{{ $result->pool }}</td>
                                        <td class="w-40">
                                            <a href="{{ route('biss.index') }}" class="text-left">{{ $result->rute }} </a>
                                        </td>
                                        <td class="text-left">{{ $result->namarute }}</td>
                                        <td class="text-left">{{ $result->totalBis }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
                        {{ $results->appends(['search' => $search])->links('pagination::bootstrap-4') }}
                    </div>

                    {{-- <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <li class="page-item {{ $result->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $result->previousPageUrl() }}"> <i class="w-4 h-4" data-lucide="chevrons-left"></i> </a>
                                </li>
                                <li class="page-item {{ $result->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $result->previousPageUrl() }}"> <i class="w-4 h-4" data-lucide="chevron-left"></i> </a>
                                </li>
                                @if($result->currentPage() > 3)
                                <li class="page-item"> <a class="page-link" href="{{ $result->url(1) }}">1</a> </li>
                                <li class="page-item"> <a class="page-link" href="{{ $result->previousPageUrl() }}">...</a> </li>
                                @endif
                                @foreach(range(1, $result->lastPage()) as $page)
                                    @if($page >= $result->currentPage() - 1 && $page <= $result->currentPage() + 1)
                                        <li class="page-item {{ $result->currentPage() == $page ? 'active' : '' }}"> <a class="page-link" href="{{ $result->url($page) }}">{{ $page }}</a> </li>
                                    @endif
                                @endforeach
                                @if($result->currentPage() < $result->lastPage() - 2)
                                <li class="page-item"> <a class="page-link" href="{{ $result->nextPageUrl() }}">...</a> </li>
                                <li class="page-item"> <a class="page-link" href="{{ $result->url($result->lastPage()) }}">{{ $result->lastPage() }}</a> </li>
                                @endif
                                <li class="page-item {{ $result->currentPage() == $result->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $result->nextPageUrl() }}"> <i class="w-4 h-4" data-lucide="chevron-right"></i> </a>
                                </li>
                                <li class="page-item {{ $result->currentPage() == $result->lastPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $result->url($result->lastPage()) }}"> <i class="w-4 h-4" data-lucide="chevrons-right"></i> </a>
                                </li>
                            </ul>
                        </nav>
                        <form action="" method="GET">
                            <select class="w-20 form-select box mt-3 sm:mt-0" onchange="window.location.href=this.value">
                                <option value="?per_page=10">10</option>
                                <option value="?per_page=25">25</option>
                                <option value="?per_page=35">35</option>
                                <option value="?per_page=50">50</option>
                              </select>
                              <span class="ml-2 text-gray-600">per page</span>
                        </form>
                    </div> --}}
                </div>
                <!-- END: Weekly Top Products -->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <!-- BEGIN: Transactions -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Bis Per Pool
                            </h2>
                        </div>
                        <div class="mt-5">
                            @foreach ($poolResults as $poolResult)
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="font-medium">{{ $loop->iteration }}</div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $poolResult->pool }}</div>
                                        </div>
                                        <div class="text-success">{{ $poolResult->jml_bis }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- END: Transactions -->

                    <!-- BEGIN: Important Notes -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 2xl:col-start-auto 2xl:row-start-auto mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-auto">
                                Catatan Penting
                            </h2>
                            <button data-carousel="important-notes" data-target="prev" class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2"> <i data-lucide="chevron-left" class="w-4 h-4"></i> </button>
                            <button data-carousel="important-notes" data-target="next" class="tiny-slider-navigator btn px-2 border-slate-300 text-slate-600 dark:text-slate-300 mr-2"> <i data-lucide="chevron-right" class="w-4 h-4"></i> </button>
                        </div>
                        <div class="mt-5 intro-x">
                            <div class="box zoom-in">
                                <div class="tiny-slider" id="important-notes">
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                        <div class="text-slate-400 mt-1">20 Hours ago</div>
                                        <div class="text-slate-500 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                            <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                        <div class="text-slate-400 mt-1">20 Hours ago</div>
                                        <div class="text-slate-500 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                            <button type="button" class="btn btn-outline-secondary py-1 px-2  ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">Lorem Ipsum is simply dummy text</div>
                                        <div class="text-slate-400 mt-1">20 Hours ago</div>
                                        <div class="text-slate-500 text-justify mt-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button" class="btn btn-secondary py-1 px-2">View Notes</button>
                                            <button type="button" class="btn btn-outline-secondary py-1 px-2  ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Important Notes -->

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
