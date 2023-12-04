
<nav class="side-nav">
    <a href="/" class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="Midone - HTML Admin Template" class="w-24" src="{{ asset('assets/images/logoputih.png') }}">
        <span class="hidden xl:block text-white text-sm ml-2">{{ auth()->user()->name }}</span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="#" class="side-menu side-menu--active">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                    <div class="side-menu__sub-icon transform rotate-180"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__sub-open">
               <li>
                    <a href="{{ route('dashboardops.index') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                        <div class="side-menu__title"> Operasi </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="globe"></i> </div>
                        <div class="side-menu__title"> Lapangan </div>
                    </a>
                </li>
                <li>
                   <a href="#" class="side-menu side-menu--active">
                        <div class="side-menu__icon"> <i data-lucide="hammer"></i> </div>
                        <div class="side-menu__title"> Tehnik </div>
                    </a>
                </li>
                <li>
                     <a href="#" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                        <div class="side-menu__title"> Checking </div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Admin -->
        {{-- @can('super admin','admin') --}}
        {{-- @if (Auth::user()->hasRole('super admin') || Auth::user()->hasnRole('admin') || Auth::user()->hasRole('owner')) --}}
            <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                        <div class="side-menu__title">
                            Administrator
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                                <div class="side-menu__title"> Data Kelurahan </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Perusahaan </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="umbrella"></i> </div>
                                <div class="side-menu__title"> Products </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="flag"></i> </div>
                                <div class="side-menu__title"> Divisi </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="paperclip"></i> </div>
                                <div class="side-menu__title"> Jabatan </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="map-pin"></i> </div>
                                <div class="side-menu__title"> Pool </div>
                            </a>
                        </li>
                        <li>
                            <a href="$" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="share-2"></i> </div>
                                <div class="side-menu__title"> Route</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="globe"></i> </div>
                                <div class="side-menu__title"> Kota Tujuan</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="dollar-sign"></i> </div>
                                <div class="side-menu__title"> Tarif Rute</div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="pen-tool"></i> </div>
                                <div class="side-menu__title"> Data Bus </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                                <div class="side-menu__title"> Kategori</div>
                            </a>
                        </li>
                    </ul>
                </li>

            <!-- user -->
            <li>
                <a href="javascript:;" class="side-menu">
                    <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                    <div class="side-menu__title">
                        Users
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('users.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                            <div class="side-menu__title"> User </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="key"></i> </div>
                            <div class="side-menu__title"> Roles </div>
                        </a>
                    </li>
                    <li>
                        <a href="" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="mic-off"></i> </div>
                            <div class="side-menu__title"> Permission </div>
                        </a>
                    </li>
                </ul>
            </li>
        {{-- @endif --}}

         {{-- @endcan --}}
    </ul>
</nav>
