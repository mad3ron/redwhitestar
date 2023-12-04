
<nav class="side-nav side-nav--simple">
    <a href="/" class="intro-x flex items-center pl-1 pt-4 mt-3">
        <img alt="Midone - HTML Admin Template" class="w-24" src="{{ asset('assets/images/logoPP.png') }}">
    </a>
    <div class="mt-5">
        <p><span class="hidden xl:block text-white text-xs ml-2">{{ auth()->user()->name }}</span></p>
    </div>

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
            <ul class="side-menu__sub-open--active">
                @if (Auth::check())
                    @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('edp') || Auth::user()->hasRole('operasi') || Auth::user()->hasRole('owner'))
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="volume-2"></i> </div>
                                <div class="side-menu__title"> Operasi </div>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('operasi') || Auth::user()->hasRole('lapangan') || Auth::user()->hasRole('edp'))
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="globe"></i> </div>
                                <div class="side-menu__title"> Lapangan </div>
                            </a>
                        </li>
                    @endif
                <li>
                    {{-- @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('tehnik') || Auth::user()->hasRole('owner')) --}}
                    <a href="#" class="side-menu side-menu--active">
                        <div class="side-menu__icon"> <i data-lucide="hammer"></i> </div>
                        <div class="side-menu__title"> Tehnik </div>
                    </a>
                    {{-- @endif --}}
                </li>
                <li>
                    @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('Checking') || Auth::user()->hasRole('owner'))
                    <a href="#" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                        <div class="side-menu__title"> Checking </div>
                    </a>
                    @endif
                </li>
                @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('edp') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('owner'))
                        <li>
                            <a href="{{ route('posts.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="edit-3"></i> </div>
                                <div class="side-menu__title"> Catatan </div>
                            </a>
                        </li>
                    @endif
            @endif
            </ul>
        </li>


        @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
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
                    <li>
                        <a href="{{ route('userapps.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="pen-tool"></i> </div>
                            <div class="side-menu__title"> User Aplikasi </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kelurahans.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                            <div class="side-menu__title"> Data Kelurahan </div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

  <!-- Element -->
        @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('edp'))

            <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="video"></i> </div>
                        <div class="side-menu__title">
                            Administrator
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{ route('perusahaans.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Perusahaan </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="umbrella"></i> </div>
                                <div class="side-menu__title"> Products </div>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="flag"></i> </div>
                                <div class="side-menu__title"> Divisi </div>
                            </a>
                        </li> --}}

                        <li>
                            <a href="{{ route('pool.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="map-pin"></i> </div>
                                <div class="side-menu__title"> Pool </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('rute.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="share-2"></i> </div>
                                <div class="side-menu__title"> Route</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('biss.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="pen-tool"></i> </div>
                                <div class="side-menu__title"> Data Bus </div>
                            </a>
                        </li>

                    </ul>
                </li>
        @endif

         <!-- Hrd -->
         @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner') || Auth::user()->hasRole('hrd') || Auth::user()->hasRole('edp'))
            <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                        <div class="side-menu__title">
                            HRD
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('jabatans.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="paperclip"></i> </div>
                                <div class="side-menu__title"> Jabatan </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('biodatas.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                                <div class="side-menu__title"> Biodata </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('karyawans.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                                <div class="side-menu__title"> Karyawan </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengemudi.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="user-check"></i> </div>
                                <div class="side-menu__title"> Pengemudi </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kondektur.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="user-plus"></i> </div>
                                <div class="side-menu__title"> Kondektur </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
         @endif

         <!-- CSO -->
        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner')
            || Auth::user()->hasRole('edp')|| Auth::user()->hasRole('cso'))
        {{-- <li class="side-nav__devider my-6"></li> --}}
            <li>
                <a href="javascript:;" class="side-menu">
                    <div class="side-menu__icon"> <i data-lucide="twitter"></i> </div>
                    <div class="side-menu__title">
                        Customer Service
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('pemesanan.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="shopping-cart"></i> </div>
                            <div class="side-menu__title"> Pemesanan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pembayaran.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="bell"></i> </div>
                            <div class="side-menu__title"> Pembayaran</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jadwal.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="bell"></i> </div>
                            <div class="side-menu__title"> Jadwal Bis</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tujuan.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="send"></i> </div>
                            <div class="side-menu__title"> Tujuan</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('armada.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="cpu"></i> </div>
                            <div class="side-menu__title"> Paket</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- Operasi -->
        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('edp') || Auth::user()->hasRole('operasi')|| Auth::user()->hasRole('manager'))
            {{-- <li class="side-nav__devider my-6"></li> --}}
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="bus"></i> </div>
                        <div class="side-menu__title">
                            Operasional
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{ route('spj-keluar.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                                <div class="side-menu__title"> Spj Keluar </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('spj-masuk.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Spj Masuk </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posisis.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                                <div class="side-menu__title"> Posisi</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tarifpnps.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="dollar-sign"></i> </div>
                                <div class="side-menu__title"> Tarif Pos</div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bisrekaps.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Bis Per Pool </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pendharians.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Pendapatan Harian </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('buschecks.index') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Cek Posisi Bis </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </li>
        @endif

        <!-- lapangan -->
        @if (Auth::user()->hasRole('super admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner') || Auth::user()->hasRole('hrd'))
        {{-- <li class="side-nav__devider my-6"></li> --}}
            <li>
                <a href="javascript:;" class="side-menu">
                    <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                    <div class="side-menu__title">
                        Lapangan
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="">
                    <li>
                        <a href="{{ route('poscheckers.index') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="globe"></i> </div>
                            <div class="side-menu__title"> Pos Checker</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- Tehnik -->
        @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner') || Auth::user()->hasRole('tehnik'))
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                        <div class="side-menu__title">
                            Tehnik
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                                <div class="side-menu__title"> SPK Keluar </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> SPK Masuk </div>
                            </a>
                        </li>
                    </ul>
                </li>
        @endif

        <!-- Center Logistik -->
        <li class="side-nav__devider my-6"></li>
        @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('center logistik'))
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="truck"></i> </div>
                        <div class="side-menu__title">
                            Center Logistik
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                                <div class="side-menu__title"> Supplier </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Barang Masuk </div>
                            </a>
                        </li>
                    </ul>
                </li>
        @endif

        <!-- Logistik -->
        @if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('logistik'))
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="database"></i> </div>
                        <div class="side-menu__title">
                            Logistik
                            <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="briefcase"></i> </div>
                                <div class="side-menu__title"> Supplier </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="side-menu">
                                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                <div class="side-menu__title"> Barang Masuk </div>
                            </a>
                        </li>
                    </ul>
                </li>
        @endif
    </ul>
</nav>
