<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone - HTML Admin Template" class="w-20" src="{{ asset('assets/images/logoputih.png') }}">
        </a>
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <div class="scrollable">
        <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        <ul class="scrollable__content py-2">
            <li>
                <a href="javascript:;.html" class="menu menu--active">
                    <div class="menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="menu__title"> Dashboard <i data-lucide="chevron-down" class="menu__sub-icon transform rotate-180"></i> </div>
                </a>
                <ul class="menu__sub-open">
                    <li>
                        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('operasi') || Auth::user()->hasRole('owner'))
                        <a href="#" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="volume-2"></i> </div>
                            <div class="menu__title"> Operasi </div>
                        </a>
                        @endif
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-2.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="globe"></i> </div>
                            <div class="menu__title"> Lapangan </div>
                        </a>
                    </li>
                    <li>
                        <a href="index.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="hammer"></i> </div>
                            <div class="menu__title"> Tehnik </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-dashboard-overview-4.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="menu__title"> Keuangan </div>
                        </a>
                    </li>
                </ul>
            </li>
                        <!-- Operasi -->
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-lucide="bus"></i> </div>
                    <div class="menu__title"> Operasional <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="#" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="briefcase"></i> </div>
                            <div class="menu__title"> Jam Keberangkatan </div>
                        </a>
                    </li>
                    <li>
                        <a href="simple-menu-light-dashboard-overview-1.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="skip-forward"></i> </div>
                            <div class="menu__title"> Spj Keluar </div>
                        </a>
                    </li>
                    <li>
                        <a href="top-menu-light-dashboard-overview-1.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="skip-back"></i> </div>
                            <div class="menu__title"> Spj Masuk </div>
                        </a>
                    </li>
                    <li>
                        <a href="top-menu-light-dashboard-overview-1.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Laporan </div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Terminal -->
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-lucide="file-text"></i> </div>
                    <div class="menu__title"> Keterminalan <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="#" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Kedatangan </div>
                        </a>
                    </li>
                    <li>
                        <a href="simple-menu-light-dashboard-overview-1.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Keberangkatan </div>
                        </a>
                    </li>
                    <li>
                        <a href="top-menu-light-dashboard-overview-1.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Laporan </div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Checker -->
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-lucide="film"></i> </div>
                    <div class="menu__title"> Cheker <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="#" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Bis Tiba </div>
                        </a>
                    </li>
                    <li>
                        <a href="top-menu-light-dashboard-overview-1.html" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Laporan </div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu__devider my-6"></li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-lucide="edit"></i> </div>
                    <div class="menu__title"> Tehnik Checking <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="side-menu-light-crud-data-list.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Bis Masuk </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-crud-form.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Order Barang </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-crud-data-list.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Bis Keluar </div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="menu">
                    <div class="menu__icon"> <i data-lucide="settings"></i> </div>
                    <div class="menu__title"> Service <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                </a>
                <ul class="">
                    <li>
                        <a href="side-menu-light-users-layout-1.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Perbaikan </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-users-layout-2.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Pemasangan Barang </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-users-layout-3.html" class="menu">
                            <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="menu__title"> Mekanik </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
