<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="@yield('seo_keywords', '') {{ config('mpcsuiblade.seo.keywords') }}">
    <meta name="description" content="@yield('seo_description', config('mpcsuiblade.seo.description'))">

    <meta itemprop="name" content="@yield('app_title', '') - {{ config('mpcsuiblade.seo.title') }}">
    <meta itemprop="description" content="@yield('seo_description', config('mpcsuiblade.seo.description'))">
    <meta itemprop="image" content="@yield('seo_image', url('/').config('mpcsuiblade.seo.image'))">

    <meta property="og:title" content="@yield('app_title', '') - {{ config('mpcsuiblade.seo.title') }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:description" content="@yield('seo_description', config('mpcsuiblade.seo.description'))">
    <meta property="og:site_name" content="{{ config('mpcsuiblade.seo.title') }}">
    <meta property="og:image" content="@yield('seo_image', url('/').config('mpcsuiblade.seo.image'))">

    <meta name="twitter:card" content="article">
    <meta name="twitter:site" content="{{ config('mpcsuiblade.seo.title') }}">
    <meta name="twitter:title" content="@yield('app_title', '') - {{ config('mpcsuiblade.seo.title') }}">
    <meta itemprop="twitter:description" content="@yield('seo_description', config('mpcsuiblade.seo.description'))">
    <meta name="twitter:creator" content="{{ config('mpcsuiblade.seo.title') }}">
    <meta name="twitter:image" content="@yield('seo_image', url('/').config('mpcsuiblade.seo.image'))">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <title>@yield('app_title', '') - {{ config('mpcsuiblade.seo.title') }}</title>

    <!-- Before APP CSS -->
    @stack('before_app_css')
    <!-- // Before APP CSS -->

    <link rel="stylesheet" href="{{ mix('/vendor/exit11/ui-blade/css/default/app.css') }}">
    <link rel="stylesheet" href="">

    <!-- After APP CSS -->
    @stack('after_app_css')
    <!-- // After APP CSS -->

    <script>
        function MPCSUI() {}
        MPCSUI.token = "{{ csrf_token() }}"

        @if (config('app.debug'))
            {{-- 개발 디버깅용 변수 --}}
            MPCSUI.appDebug = true;
        @endif
    </script>

    @stack('header_script')

</head>

<body>
    {{-- PRELOAD --}}
    {{-- @component(UiBlade::theme('components.preload'), ['color' => 'primary'])
    @endcomponent --}}

    {{-- header, modal 레이어 팝업 --}}
    @yield('app_notification')

    <div id="pageWrapper" class="page-wrapper pb-5">

        {{-- HEADER --}}
        @include(UiBlade::theme('partials.header'))

        <div class="page-wrapper--main">

            <nav class="navbar sticky-top navbar-light d-none d-lg-flex border-bottom bg-white">
                <div class="container-fluid">
                    <ul class="nav justify-content-center w-100">
                        @component(UiBlade::theme('components.item_nav'), ['menus' => UiBlade::getMenuData()])
                        @endcomponent
                    </ul>
                </div>
            </nav>

            <main
                class="container-fluid py-3 {{ \Route::current()->getName() == 'official.index' ? 'main-wrapper' : 'sub-wrapper' }}">
                @yield('app_content')
            </main>
        </div>

    </div>

    {{-- 오버 캔버스 --}}
    <div class="offcanvas-nav offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav">
        <div class="offcanvas-header bg-primary align-items-center">
            <a href="http://39.113.249.123:9001/gpis" class="brand-link">
                <img src="/vendor/mpcs-ui/bootstrap5/images/header_logo.png" alt="Header Logo"
                    class="brand-image navbar-img" style="opacity: .8">
            </a>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <!-- Offcanvas navbar links -->
            <ul class="nav flex-column">
                @component(UiBlade::theme('components.item_nav'), ['menus' => UiBlade::getMenuData()])
                @endcomponent
            </ul>
        </div>
    </div>

    <div id="loadWrapper" class="load-wrapper">
        <div class="loader"></div>
    </div>

    <!-- Before APP SCRIPTS -->
    @stack('before_app_scripts')
    <!-- // Before APP SCRIPTS -->

    <script src="{{ mix('/vendor/mpcs-ui/bootstrap5/js/app.js') }}"></script>

    <!-- After APP SCRIPTS -->
    @stack('after_app_scripts')
    <!-- // After APP SCRIPTS -->

    @include(Bootstrap5::theme('partials.toast'))

    {{-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
        appId: "0b0190f2-b347-4a83-921e-d174f5370480",
        });
    });
    </script> --}}

    {{-- Global site tag (gtag.js) - Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-180690677-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-180690677-1');
    </script>

    {{-- 네이버 웹 애널리틱스 스크립트 --}}
    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if (!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "92c7e196704840";
        if (window.wcs) {
            wcs_do();
        }
    </script>

    <!-- Channel Plugin Scripts -->
    {{-- <script>
        (function() {
            var w = window;
            if (w.ChannelIO) {
                return (window.console.error || window.console.log || function() {})(
                    'ChannelIO script included twice.');
            }
            var ch = function() {
                ch.c(arguments);
            };
            ch.q = [];
            ch.c = function(args) {
                ch.q.push(args);
            };
            w.ChannelIO = ch;

            function l() {
                if (w.ChannelIOInitialized) {
                    return;
                }
                w.ChannelIOInitialized = true;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
                s.charset = 'UTF-8';
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            }
            if (document.readyState === 'complete') {
                l();
            } else if (window.attachEvent) {
                window.attachEvent('onload', l);
            } else {
                window.addEventListener('DOMContentLoaded', l, false);
                window.addEventListener('load', l, false);
            }
        })();
        ChannelIO('boot', {
            "pluginKey": "9c04349c-f936-46b9-811f-f4b5ea91c376"
        });
    </script> --}}
    <!-- End Channel Plugin -->


    {{-- small.chat --}}
    {{-- <script src="https://embed.small.chat/T01GD0QR2HWG01GFD84GSC.js" async></script> --}}
</body>

</html>
