<!-- [ Profile ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
        <a href="#!" class="b-brand">
            <img src="{{ asset('images/logo-pembiayaan-syariah.svg') }}" alt="" class="logo images">
            <img src="{{ asset('images/logo-icon.svg') }}" alt="" class="logo-thumb images">
        </a>
    </div>

    <div class="collapse navbar-collapse d-flex justify-content-between align-items-center w-100">
        <div class="navbar-nav">
            <span class="nav-link font-weight-bold pl-2">
                {{ ucwords(str_replace(['_', '.'], ' ', Route::currentRouteName())) }}
            </span>
        </div>

        <ul class="navbar-nav">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon feather icon-settings"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <p class="py-0 my-0">{{ Auth::user()->username }}
                                {{ Auth::user()->tipe_akun == 'siswa' ? '' : '( ' . Auth::user()->tipe_akun . ' )' }}
                            </p>
                            <p class="py-0 my-0">
                                {{ Auth::user()->tipe_akun == 'admin' ? '' : '( Kode Tempat : ' . Auth::user()->kode_tempat . ' )' }}
                            </p>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dud-logout" title="Logout"
                                    style="border: none; background: none;">
                                    <i class="feather icon-log-out"></i>
                                </button>
                            </form>
                        </div>
                        <ul class="pro-body">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"
                                        style="background: none; border: none; width: 100%; text-align: left; color: red;">
                                        <i class="feather icon-log-out mr-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<!-- [ Profile ] end -->
