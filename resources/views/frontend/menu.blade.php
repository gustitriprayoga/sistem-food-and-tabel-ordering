@extends('layouts.frontend.master')

@section('title', 'Cafe Niskala')

@section('content')

    <!-- subheader -->
    <section id="subheader" class="jarallax text-light">
        <img src="{{ asset('frontend/images/background/bg-2.jpg') }}" class="jarallax-img" alt="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center wow fadeInUp">
                        <h2 class="s1 mb-40">Discover</h2>
                        <h2 class="s2">Our Menu</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Menu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content" class="no-bottom no-top">
        <!-- section begin -->
        <section id="section-coffee" aria-label="section-coffee">
            <div class="container">
                <div class="col-md-12">
                    <ul id="filters" class="wow fadeInUp" data-wow-delay="0s">
                        <li><a href="#" data-filter="*" class="selected">All Menu</a></li>
                        <li><a href="#" data-filter=".coffee">Coffee</a></li>
                        <li><a href="#" data-filter=".non-coffee">Non Coffee</a></li>
                        <li><a href="#" data-filter=".main-dishes">Main Dishes</a></li>
                        <li><a href="#" data-filter=".breads">Breads</a></li>
                    </ul>
                    <div class="spacer-single"></div>
                </div>

                <div id="gallery" class="row masonry">

                    <div class="col-lg-6 col-sm-12 item coffee">
                        <div class="menu-wrap">
                            <div class="menu-item thead">
                                <div class="c1">coffee</div>
                                <div class="c2">Medium<span>16 oz</span></div>
                                <div class="c3">Large<span>20 oz</span></div>
                            </div>

                            <div class="menu-item">
                                <div class="c1">Brewed coffee<span>Rich flavor of freshly brewed coffee</span></div>
                                <div class="c2">1.85</div>
                                <div class="c3">2.35</div>
                            </div>

                            <div class="menu-item">
                                <div class="c1">Espresso<span>Espresso, where passion meets perfection.</span></div>
                                <div class="c2">1.75</div>
                                <div class="c3">2.20</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Mocchiato<span>The perfect harmony of espresso and sweetness</span>
                                </div>
                                <div class="c2">1.94</div>
                                <div class="c3">2.25</div>
                            </div>

                            <div class="menu-item">
                                <div class="c1">Classic Cappucino<span>A timeless delight brewed just for you.</span>
                                </div>
                                <div class="c2">2.90</div>
                                <div class="c3">3.90</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Cappucino<span>Where rich espresso meets frothy perfection.</span></div>
                                <div class="c2">3.15</div>
                                <div class="c3">4.15</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Mocha latte<span>The perfect blend of chocolate and espresso.</span>
                                </div>
                                <div class="c2">3.45</div>
                                <div class="c3">4.35</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Caramel late<span>Where smooth espresso meets golden caramel
                                        bliss.</span></div>
                                <div class="c2">3.45</div>
                                <div class="c3">4.35</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Cafe americano<span>The essence of pure coffee bliss.</span></div>
                                <div class="c2">2.25</div>
                                <div class="c3">3.50</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 item non-coffee">
                        <div class="menu-wrap">
                            <div class="menu-item thead">
                                <div class="c1">non coffee</div>
                                <div class="c2">Medium<span>16 oz</span></div>
                                <div class="c3">Large<span>20 oz</span></div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Apple Tea<span>The essence of orchard-fresh apples in every sip</span>
                                </div>
                                <div class="c2">1.85</div>
                                <div class="c3">2.35</div>
                            </div>

                            <div class="menu-item">
                                <div class="c1">Steamer<span>Blend of steamed milk and flavorful syrup</span></div>
                                <div class="c2">2.85</div>
                                <div class="c3">3.85</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Hot Chocolate<span>Crafted from the finest cocoa and creamy milk</span>
                                </div>
                                <div class="c2">2.85</div>
                                <div class="c3">3.85</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Lemonade<span>Bursting with vibrant citrus flavors</span></div>
                                <div class="c2">2.50</div>
                                <div class="c3">3.50</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Fruit smoothie<span>Bursting with the natural sweetness of ripe
                                        fruits</span></div>
                                <div class="c2">3.15</div>
                                <div class="c3">4.15</div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 item breads">
                        <div class="menu-wrap">
                            <div class="menu-item thead">
                                <div class="c1">breads</div>
                                <div class="c2"></div>
                                <div class="c3">Price</div>
                            </div>

                            <div class="spacer-half"></div>

                            <div class="menu-item">
                                <div class="c1">Plain bread<span>Soft and golden with a tantalizing aroma</span></div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Milk bread<span>Infused with the richness of milk</span></div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Sandwich bread<span>Classic combinations like ham and cheese</span>
                                </div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Brown bread<span>Crafted from whole grain flour</span></div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Garlic bread<span>Infused with aromatic garlic and rich butter</span>
                                </div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Wheat bread<span>With hearty texture and nutty flavor</span></div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Bannana bread<span>With its banana taste and delightful aroma</span>
                                </div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>

                            <div class="menu-item">
                                <div class="c1">Burger bun<span>With fluffy texture and subtle sweetness</span></div>
                                <div class="c2"></div>
                                <div class="c3">2.75</div>
                            </div>

                            <div class="spacer-half"></div>

                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 item main-dishes">
                        <div class="menu-wrap">
                            <div class="menu-item thead">
                                <div class="c1">main dishes</div>
                                <div class="c2"></div>
                                <div class="c3">Price</div>
                            </div>

                            <div class="spacer-half"></div>

                            <div class="menu-item">
                                <div class="c1">Chicken burger<span>Seasoned to perfection and grilled to juicy
                                        perfection</span></div>
                                <div class="c2"></div>
                                <div class="c3">4.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Chicken pizza<span>Seasoned chicken pieces, melting cheese, and of
                                        fresh vegetables.</span></div>
                                <div class="c2"></div>
                                <div class="c3">8.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Veg pizza<span>The medley of fresh vegetables</span></div>
                                <div class="c2"></div>
                                <div class="c3">6.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Chicken grilled pizza<span>Topped with succulent grilled chicken</span>
                                </div>
                                <div class="c2"></div>
                                <div class="c3">8.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Veg grilled pizza<span>The medley of fresh grilled vegetables</span>
                                </div>
                                <div class="c2"></div>
                                <div class="c3">6.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Chicken sandwich<span>Grilled chicken breast, toasted buns, lettuce,
                                        juicy tomatoes and creamy mayo</span></div>
                                <div class="c2"></div>
                                <div class="c3">4.75</div>
                            </div>


                            <div class="menu-item">
                                <div class="c1">Veg sandwich<span>Toasted buns, the medley of fresh grilled vegetables
                                        and creamy mayo</span></div>
                                <div class="c2"></div>
                                <div class="c3">3.75</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

    </div>
@endsection
