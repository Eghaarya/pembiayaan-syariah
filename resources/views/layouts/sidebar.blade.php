<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="#!" class="b-brand">
                <img src="{{ asset('images/logo-pembiayaan-syariah.svg') }}" alt="" class="logo images">
                <img src="{{ asset('images/logo-icon.svg') }}" alt="" class="logo-thumb images">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">

                {{-- Data Nasabah --}}
                <li
                    class="nav-item pcoded-hasmenu {{ Route::is('nasabah.profil.*') || Route::is('nasabah.pekerjaan.*') ? 'active pcoded-trigger' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Form Data Nasabah</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="nav-item {{ Route::is('nasabah.profil.*') ? 'active' : '' }}">
                            <a href="{{ route('nasabah.profil.data') }}"
                                class="nav-link {{ Route::is('nasabah.profil.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Profil Nasabah</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('nasabah.pekerjaan.*') ? 'active' : '' }}">
                            <a href="{{ route('nasabah.pekerjaan.data') }}"
                                class="nav-link {{ Route::is('nasabah.pekerjaan.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Pekerjaan Nasabah</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item pcoded-menu-caption">
                    <label>Pengajuan Pembiayaan</label>
                </li>

                {{-- (1). Pengajuan Murabahah --}}
                <li
                    class="nav-item pcoded-hasmenu {{ Route::is('murabahah.pengajuan.*') || Route::is('murabahah.limac.*') || Route::is('murabahah.dokumentasi.*') || Route::is('murabahah.cetak.*') ? 'active pcoded-trigger' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                        <span class="pcoded-mtext">(1). Murabahah</span>
                    </a>
                    <ul class="pcoded-submenu {{ Route::is('murabahah.limac.*') ? 'active pcoded-trigger' : '' }}">
                        <li class="nav-item {{ Route::is('murabahah.pengajuan.*') ? 'active' : '' }}">
                            <a href="{{ route('murabahah.pengajuan.data') }}"
                                class="nav-link {{ Route::is('murabahah.pengajuan.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Buat Pengajuan</span>
                            </a>
                        </li>
                        <li class="pcoded-hasmenu {{ Route::is('murabahah.limac.*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!">5 C</a>
                            <ul class="pcoded-submenu">
                                <li class="nav-item {{ Route::is('murabahah.limac.character.*') ? 'active' : '' }}">
                                    <a href="{{ route('murabahah.limac.character.data') }}"
                                        class="nav-link {{ Route::is('murabahah.limac.character.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Character</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Route::is('murabahah.limac.capacity.*') ? 'active' : '' }}">
                                    <a href="{{ route('murabahah.limac.capacity.data') }}"
                                        class="nav-link {{ Route::is('murabahah.limac.capacity.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Capacity</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Route::is('murabahah.limac.capital.*') ? 'active' : '' }}">
                                    <a href="{{ route('murabahah.limac.capital.data') }}"
                                        class="nav-link {{ Route::is('murabahah.limac.capital.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Capital</span>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Route::is('murabahah.limac.collateralkpr.*') ? 'active' : '' }}">
                                    <a href="{{ route('murabahah.limac.collateralkpr.data') }}"
                                        class="nav-link {{ Route::is('murabahah.limac.collateralkpr.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Collateral KPR</span>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Route::is('murabahah.limac.collateralbermotor.*') ? 'active' : '' }}">
                                    <a href="{{ route('murabahah.limac.collateralbermotor.data') }}"
                                        class="nav-link {{ Route::is('murabahah.limac.collateralbermotor.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Collateral Bermotor</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Route::is('murabahah.limac.condition.*') ? 'active' : '' }}">
                                    <a href="{{ route('murabahah.limac.condition.data') }}"
                                        class="nav-link {{ Route::is('murabahah.limac.condition.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Condition</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('murabahah.dokumentasi.*') ? 'active' : '' }}">
                            <a href="{{ route('murabahah.dokumentasi.data') }}"
                                class="nav-link {{ Route::is('murabahah.dokumentasi.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Dokumentasi</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('murabahah.cetak.*') ? 'active' : '' }}">
                            <a href="{{ route('murabahah.cetak.data') }}"
                                class="nav-link {{ Route::is('murabahah.cetak.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Cetak</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- (2). Pengajuan Multiguna --}}
                <li
                    class="nav-item pcoded-hasmenu {{ Route::is('multiguna.pengajuan.*') || Route::is('multiguna.limac.*') || Route::is('multiguna.dokumentasi.*') || Route::is('multiguna.cetak.*') ? 'active pcoded-trigger' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                        <span class="pcoded-mtext">(2). Multiguna</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="nav-item {{ Route::is('multiguna.pengajuan.*') ? 'active' : '' }}">
                            <a href="{{ route('multiguna.pengajuan.data') }}"
                                class="nav-link {{ Route::is('multiguna.pengajuan.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Buat Pengajuan</span>
                            </a>
                        </li>
                        <li class="pcoded-hasmenu {{ Route::is('multiguna.limac.*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!">5 C</a>
                            <ul class="pcoded-submenu">
                                <li class="nav-item {{ Route::is('multiguna.limac.character.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.character.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.character.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Character</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Route::is('multiguna.limac.capacity.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.capacity.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.capacity.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Capacity</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Route::is('multiguna.limac.capital.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.capital.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.capital.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Capital</span>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Route::is('multiguna.limac.collateralsk.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.collateralsk.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.collateralsk.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Collateral SK</span>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Route::is('multiguna.limac.collateralproperti.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.collateralproperti.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.collateralproperti.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Collateral Properti</span>
                                    </a>
                                </li>
                                <li
                                    class="nav-item {{ Route::is('multiguna.limac.collateralbermotor.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.collateralbermotor.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.collateralbermotor.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Collateral Bermotor</span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Route::is('multiguna.limac.condition.*') ? 'active' : '' }}">
                                    <a href="{{ route('multiguna.limac.condition.data') }}"
                                        class="nav-link {{ Route::is('multiguna.limac.condition.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Condition</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ Route::is('multiguna.dokumentasi.*') ? 'active' : '' }}">
                            <a href="{{ route('multiguna.dokumentasi.data') }}"
                                class="nav-link {{ Route::is('multiguna.dokumentasi.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Dokumentasi</span>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('multiguna.cetak.*') ? 'active' : '' }}">
                            <a href="{{ route('multiguna.cetak.data') }}"
                                class="nav-link {{ Route::is('multiguna.cetak.*') ? 'active' : '' }}">
                                <span class="pcoded-mtext">Cetak</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @unless (auth()->user()->tipe_akun == 'siswa')
                    <li class="nav-item pcoded-menu-caption">
                        <label>Akun dan Kode Tempat</label>
                    </li>

                    <li
                        class="nav-item pcoded-hasmenu 
            {{ request()->routeIs('admin.akun.*') || request()->routeIs('admin.tempat.*') ? 'active pcoded-trigger' : '' }}">
                        <a href="#!" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                            <span class="pcoded-mtext">Admin</span>
                        </a>
                        <ul class="pcoded-submenu">
                            @unless (auth()->user()->tipe_akun !== 'admin')
                                <li class="nav-item {{ request()->routeIs('admin.tempat.*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.tempat.data') }}"
                                        class="nav-link {{ request()->routeIs('admin.tempat.*') ? 'active' : '' }}">
                                        <span class="pcoded-mtext">Kode Tempat</span>
                                    </a>
                                </li>
                            @endunless
                            <li class="nav-item {{ request()->routeIs('admin.akun.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.akun.data') }}"
                                    class="nav-link {{ request()->routeIs('admin.akun.*') ? 'active' : '' }}">
                                    <span class="pcoded-mtext">Akun</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endunless
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
