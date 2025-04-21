<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <title>Niskala Cafe - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- CSS Files
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/coloring.css') }}" type="text/css">

    <!-- css for scheme color -->
    <link rel="stylesheet" href="{{ asset('frontend/css/colors/maroon-gold.css') }}" type="text/css" id="colors">

    <!-- Slider Revolution Stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/rev-settings.css') }}">

</head>

<body>

    <div id="wrapper">

        <!-- header begin -->
        @include('layouts.frontend.header')
        <!-- header close -->

        <!-- content begin -->
        <div id="content" class="no-bottom no-top">

            @yield('content')

        </div>


        <!-- footer begin -->
        @include('layouts.frontend.footer')
        <!-- footer close -->

        <div id="preloader">
            <div class="preloader1"></div>
        </div>
    </div>


    <!-- Javascript Files
            ================================================== -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script src="frontend/js/designesia.js"></script>

    <!-- RS5.0 Core JS Files -->
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js?rev=5.0') }}"></script>
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0') }}"></script>

    <!-- RS5.0 Extensions Files -->
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            // revolution slider
            jQuery("#revolution-slider").revolution({
                sliderType: "standard",
                sliderLayout: "fullscreen",
                delay: 3500,
                navigation: {
                    arrows: {
                        enable: true
                    }
                },
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2000,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
                },
                spinner: "off",
                gridwidth: 1140,
                gridheight: 600,
                disableProgressBar: "on"
            });
        });
    </script>

</body>

</html>
