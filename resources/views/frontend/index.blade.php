@extends('layouts.frontend.master')

@section('title', 'Selamat Datang di Cafe Niskala')

@section('content')
    <!-- parallax section -->
    <section id="section-slider" class="fullwidthbanner-container" aria-label="section-slider">
        <div id="revolution-slider">
            <ul>
                <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                    <!--  BACKGROUND IMAGE -->
                    <img src="{{ asset('frontend/images/slider/slide-1.jpg') }}" alt=""
                        data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">

                    <div class="tp-caption big-s1" data-x="center" data-y="220" data-width="none" data-height="none"
                        data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;" data-start="500" data-splitin="none"
                        data-splitout="none" data-responsive_offset="on">
                        <span class="id-color-2">Selamat Datang</span>
                    </div>

                    <div class="tp-caption very-big-white" data-x="center" data-y="260" data-width="none"
                        data-height="none" data-whitespace="nowrap"
                        data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600" data-splitin="none"
                        data-splitout="none" data-responsive_offset="on">
                        Niskala Cafe
                    </div>

                    <div class="tp-caption text-center" data-x="center" data-y="340" data-width="450" data-height="none"
                        data-whitespace="wrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                        Cari Cafe Yang Nyaman dan Menyajikan Menu Terbaik? <br> Cafe Niskala adalah Pilihan yang Tepat untuk Anda!
                    </div>

                    <div class="tp-caption" data-x="center" data-y="450" data-width="none" data-height="none"
                        data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                        <a href="#" class="btn-slider">View Menu</a>
                    </div>
                </li>

                <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                    <!--  BACKGROUND IMAGE -->
                    <img src="{{ asset('frontend/images/slider/slide-2.jpg') }}" alt=""
                        data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">

                    <div class="tp-caption big-s1" data-x="center" data-y="220" data-width="none" data-height="none"
                        data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;" data-start="500" data-splitin="none"
                        data-splitout="none" data-responsive_offset="on">
                        <span class="id-color-2">Aromatic</span>
                    </div>

                    <div class="tp-caption very-big-white" data-x="center" data-y="260" data-width="none"
                        data-height="none" data-whitespace="nowrap"
                        data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600" data-splitin="none"
                        data-splitout="none" data-responsive_offset="on">
                        Taste
                    </div>

                    <div class="tp-caption text-center" data-x="center" data-y="340" data-width="450" data-height="none"
                        data-whitespace="wrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                        Prepare to be enchanted by the seductive allure of our coffee's aromatic taste, a
                        sensory symphony that begins the moment you lift the cup to your lips.
                    </div>

                    <div class="tp-caption" data-x="center" data-y="450" data-width="none" data-height="none"
                        data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                        data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                        <a href="#" class="btn-slider">View Menu</a>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- parallax section close -->

    <!-- section begin -->
    <section>
        <div class="container">
            <div class="row aligns-item-center">
                <div class="col-lg-6">
                    <div class="text-center">
                        <h2 class="s1 id-color-2 mb-40 wow fadeInUp">Discover</h2>
                        <h2 class="s2 wow fadeInUp">Our Story</h2>
                        <div class="spacer-single"></div>
                    </div>
                    <p class="lead">In the heart of the bustling metropolis, where the rhythm of life pulses
                        relentlessly, there exists a sanctuary hidden among the chaos—a place where time slows,
                        and worries fade into the aroma of freshly ground coffee beans.</p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('frontend/images/background/bg-1.jpg') }}" alt="" class="rounded-20 img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <!-- section begin -->
    {{-- <section class="no-top">
        <div class="container">
            <div class="row bb gx-5 text-center">

                <div class="col-lg-4 wow fadeInRight">
                    <img src="images/misc/icon-1.png" alt="">
                    <div class="spacer-single"></div>
                    <h3>Aromatic Taste</h3>
                    <p>Rich, inviting, and utterly tantalizing, the aromatic taste of coffee is a sensory
                        journey that begins with the first whiff.</p>
                    <a href="#" class="btn-custom">Read More</a>
                </div>

                <div class="col-lg-4 wow fadeInRight" data-wow-delay=".1s">
                    <img src="images/misc/icon-2.png" alt="">
                    <div class="spacer-single"></div>
                    <h3>Delicious Foods</h3>
                    <p>From the first tantalizing aroma to the last lingering taste, our menu is a celebration
                        of diverse cuisines and bold creativity. </p>
                    <a href="#" class="btn-custom">Read More</a>
                </div>

                <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                    <img src="images/misc/icon-3.png" alt="">
                    <div class="spacer-single"></div>
                    <h3>Make Your Party</h3>
                    <p>Transforming our cozy café into the ultimate party destination, where friends gather,
                        laughter flows, and memories are made.</p>
                    <a href="#" class="btn-custom">Read More</a>
                </div>

            </div>
        </div>
    </section> --}}
    <!-- section close -->


    <!-- section begin -->
    <section id="section-title-1" class="text-light jarallax">
        <img src="{{ asset('frontend/images/background/bg-2.jpg') }}" class="jarallax-img" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="s1 id-color-2 mb-40 wow fadeInUp">Favorite</h2>
                        <h2 class="s2 wow fadeInUp">Coffee</h2>
                        <div class="spacer-double"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <!-- section begin -->
    <section class="jarallax" aria-label="section">
        <img src="images/background/bg-3.jpg" class="jarallax-img" alt="">
        <div class="container">
            <div class="row wow fadeInLeft">
                <div class="col-lg-6">
                    <div class="menu-item thead">
                        <div class="c1">Coffe</div>
                        <div class="c2">Hot<span>Panas</span></div>
                        <div class="c3">Ice<span>Dingin</span></div>
                    </div>


                    <div class="menu-item">
                        <div class="c1">Coffe Latte<span>Coffe Latte Enak Dan Nikmat</span>
                        </div>
                        <div class="c2">Rp 1.750</div>
                        <div class="c3">Rp 2.200</div>
                    </div>




                    <div class="spacer-single"></div>

                    <a href="menu.html" class="btn-custom">View All Menu</a>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <!-- section begin -->
    <section id="section-title-2" class="text-light jarallax">
        <img src="{{ asset('frontend/images/background/bg-4.jpg') }}" class="jarallax-img" alt="">
        <div class="container">
            <div class="row wow fadeInRight">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="s1 id-color-2 mb-40 wow fadeInUp">Favorite</h2>
                        <h2 class="s2 wow fadeInUp">Makanan</h2>
                        <div class="spacer-double"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <!-- section begin -->
    <section class="jarallax" aria-label="section">
        <img src="images/background/bg-5.jpg" class="jarallax-img" alt="">
        <div class="container">
            <div class="row wow fadeInRight">
                <div class="col-lg-6 offset-lg-6">
                    <div class="menu-item thead">
                        <div class="c1">Makanan</div>
                        <div class="c2"></div>
                        <div class="c3">Harga</div>
                    </div>

                    <div class="spacer-half"></div>

                    <div class="menu-item">
                        <div class="c1">Nasi Goreng<span>Soft and golden with a tantalizing aroma</span>
                        </div>
                        <div class="c2"></div>
                        <div class="c3">Rp. 15.000</div>
                    </div>


                    <div class="spacer-single"></div>

                    <a href="menu.html" class="btn-custom">View All Menu</a>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->


    <!-- section begin -->
    <section id="section-gallery" aria-label="section-gallery" class="no-top">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="gallery" class="gallery zoom-gallery gallery-6-cols wow fadeInUp" data-wow-delay=".3s">

                        <!-- gallery item -->
                        <div class="item">
                            <figure class="position-relative">
                                <a href="{{ asset('frontend/images/menu/view/pf%20(1).jpg') }}" title="Chocolate Croissant">
                                    <span class="d-hover">
                                        <span class="d-text">
                                            <span class="d-cap">View</span>
                                        </span>
                                    </span>
                                    <img src="{{ asset('frontend/images/menu/pf%20(1).jpg') }}" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <figure class="position-relative">
                                <a href="frontend/images/menu/view/pf%20(2).jpg" title="Croissant">
                                    <span class="d-hover">
                                        <span class="d-text">
                                            <span class="d-cap">View</span>
                                        </span>
                                    </span>
                                    <img src="frontend/images/menu/pf%20(2).jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <figure class="position-relative">
                                <a href="frontend/images/menu/view/pf%20(3).jpg" title="Doughnuts">
                                    <span class="d-hover">
                                        <span class="d-text">
                                            <span class="d-cap">View</span>
                                        </span>
                                    </span>
                                    <img src="frontend/images/menu/pf%20(3).jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <figure class="position-relative">
                                <a href="frontend/images/menu/view/pf%20(4).jpg" title="Wheat Bread">
                                    <span class="d-hover">
                                        <span class="d-text">
                                            <span class="d-cap">View</span>
                                        </span>
                                    </span>
                                    <img src="frontend/images/menu/pf%20(4).jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <figure class="position-relative">
                                <a href="frontend/images/menu/view/pf%20(5).jpg" title="Butterfly Cookies">
                                    <span class="d-hover">
                                        <span class="d-text">
                                            <span class="d-cap">View</span>
                                        </span>
                                    </span>
                                    <img src="frontend/images/menu/pf%20(5).jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- close gallery item -->

                        <!-- gallery item -->
                        <div class="item">
                            <figure class="position-relative">
                                <a href="frontend/images/menu/view/pf%20(6).jpg" title="Chocolate Puff Pastry">
                                    <span class="d-hover">
                                        <span class="d-text">
                                            <span class="d-cap">View</span>
                                        </span>
                                    </span>
                                    <img src="images/menu/pf%20(6).jpg" alt="">
                                </a>
                            </figure>
                        </div>
                        <!-- close gallery item -->

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- section close -->


    <section class="side-bg no-top no-bottom text-light bg-color" aria-label="section">
        <div class="col-lg-6 pull-right image-container jarallax">
            <img src="{{ asset('frontend/images/background/bg-side-1.jpg') }}" class="jarallax-img" alt="">
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-lg-6 offset-lg-6 wow fadeInRight">
                    <div class="padding80">
                        <div class="text-center">
                            <h2 class="s1 id-color-2 mb-40 wow fadeInUp">Customers</h2>
                            <h2 class="s2 wow fadeInUp">Review</h2>
                            <div class="spacer-single"></div>
                        </div>
                        <blockquote>
                            As a busy professional, I rely on my morning coffee to kickstart my day. The rich,
                            smooth taste and heavenly aroma never fail to perk me up and get me ready to tackle
                            whatever the day throws at me. It's like a little slice of heaven in a cup!
                            <span>Jenna Smith</span>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- section begin -->
    <section id="cta" aria-label="cta" class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 text-lg-start text-sm-center">
                    <h3><i class="id-color fa fa-phone mr10"></i>Call us now and get special offers!</h3>
                </div>

                <div class="col-lg-3 text-lg-end text-sm-center">
                    <a href="booking.html" class="btn-line-black">Call Us Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section id="section-title-1" class="text-light jarallax">
        <img src="{{ asset('frontend/images/background/bg-6.jpg') }}" class="jarallax-img" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h2 class="s1 id-color-2 mb-40 wow fadeInUp">We are</h2>
                        <h2 class="s2 wow fadeInUp">Open</h2>
                        <div class="spacer-double"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        <span class="id-color-2 bold">Senin - Kamis</span>
                        <div class="fs20">10:30 - 23:30</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        <span class="id-color-2 bold">Jum'at</span>
                        <div class="fs20">13:30 - 23:30</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text-center">
                        <span class="id-color-2 bold">Sabtu - Minggu</span>
                        <div class="fs20">10:00 - 00:00</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
