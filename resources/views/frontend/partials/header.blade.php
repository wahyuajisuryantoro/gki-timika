<header class="section page-header">
    <!--RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
            data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
            data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static"
            data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px"
            data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1"
                data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
            <div class="rd-navbar-aside-outer rd-navbar-collapse">
                <div class="rd-navbar-aside">
                    <ul class="list-inline list-inline-md">
                        <li>
                            <div class="unit unit-spacing-xs align-items-center">
                                <div class="unit-left"><span class="icon text-middle mdi-phone-in-talk mdi"></span>
                                </div>
                                <div class="unit-body"><a href="tel:#">0851 9704 0000</a></div>
                            </div>
                        </li>
                        <li>
                            <div class="unit unit-spacing-xs align-items-center">
                                <div class="unit-left"><span class="icon text-middle mdi-map-marker mdi"></span></div>
                                <div class="unit-body"><a href="#">Jl. Ahmad Yani Kwamki Baru</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="social-list">
                        <li><a href="#"><span class="icon fa fa-youtube-play"></span></a></li>
                        <li><a href="#"><span class="icon fa fa-twitter"></span></a></li>
                        <li><a href="#"><span class="icon fa fa-facebook-f"></span></a></li>
                        <li><a href="#"><span class="icon fa fa-rss"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="rd-navbar-main-outer">
                <div class="rd-navbar-main">
                    <!--RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <!--RD Navbar Toggle-->
                        <button class="rd-navbar-toggle"
                            data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!--RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <!--Brand--><a class="brand" href="index.html"><img class="brand-logo-dark"
                                    src="images/logo-default-189x54.png" alt="" width="94"
                                    height="27" /><img class="brand-logo-light" src="images/logo-default-189x54.png"
                                    alt="" width="94" height="27" /></a>
                        </div>
                    </div>
                    <div class="rd-navbar-main-element">
                        <div class="rd-navbar-nav-wrap">
                            <ul class="rd-navbar-nav">
                                <li class="rd-nav-item active"><a class="rd-nav-link"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                                </li>
                                <li class="rd-nav-item">
                                    <a class="rd-nav-link" href="#">Kebaktian</a>
                                    <ul class="rd-menu rd-navbar-dropdown">
                                        <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                                href="{{ route('kebaktian', 'minggu') }}">Minggu</a></li>
                                        <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                                href="{{ route('kebaktian', 'khusus') }}">Khusus</a></li>
                                        <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                                href="{{ route('kebaktian', 'keluarga') }}">Keluarga</a></li>
                                    </ul>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link"
                                        href="{{ route('organisasi') }}">Organisasi</a>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="#">Layanan</a>
                                    <ul class="rd-menu rd-navbar-dropdown">
                                        <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                                href="{{ route('pendaftaran.sidi') }}">Sidi</a></li>
                                        <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                                href="{{ route('pendaftaran.baptis') }}">Baptis</a></li>
                                        <li class="rd-dropdown-item"><a class="rd-dropdown-link"
                                                href="{{ route('pendaftaran.nikah') }}">Pernikahan</a></li>
                                    </ul>
                                </li>
                                <li class="rd-nav-item"><a class="rd-nav-link" href="contacts.html">Contacts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
