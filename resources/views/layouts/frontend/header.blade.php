<header class="header_center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- logo begin -->
                <div id="logo">
                    <a href="index.html">
                        <img class="logo logo_dark_bg" src="{{ asset('frontend/images/logo2.jpg') }}"
                            alt="">
                        <img class="logo logo_light_bg" src="{{ asset('frontend/images/logo2.jpg') }}"
                            alt="">
                    </a>
                </div>
                <!-- logo close -->

                <!-- small button begin -->
                <span id="menu-btn"></span>
                <!-- small button close -->

                <!-- mainmenu begin -->
                <nav>
                    <ul id="mainmenu">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ route('semuamenu') }}">menu</a></li>
                        <li><a href="{{ route('booking') }}">Booking</a></li>
                        <li><a href="#">About</a>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Gallery</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <!-- mainmenu close -->

        </div>
    </div>
</header>
