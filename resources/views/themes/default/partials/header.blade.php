<header class="page-wrapper--header">
    <div class="page-wrapper--header__container bg-primary">

        {{-- 헤더 이미지 --}}
        <div class="page-wrapper--header__container_inner">
            <nav class="nav-header">
                <div class="nav-header--main">
                    <button class="nav-header--toggler me-3" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNav" aria-controls="offcanvasNav">
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>

                </div>
                <div class="">
                    <a href="#" class="btn btn-sm btn-icon btn-outline-light">
                        <i class="mdi mdi-tent"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-icon btn-outline-light">
                        <i class="mdi mdi-tent"></i>
                    </a>
                </div>
            </nav>

            <div class="text-center">
                <div class="header-logo wow animate__animated animate__fadeInDown">
                    五都<br />二村
                </div>
                <p class="header-slogun wow animate__animated animate__fadeInDown">
                    우리만의 꿈속 캠핑장
                </p>
                <h1 class="header-brand wow animate__animated animate__zoomIn">
                    오도이촌 <br /><small>캠핑장</small>
                </h1>
            </div>
            <div class="header-copyright py-2 wow animate__animated animate__fadeInUp">
                @if (config('mpcsuiblade.seo.phone'))
                    <p class="mb-0">
                        <i class="mdi mdi-phone"></i>
                        {{ config('mpcsuiblade.seo.phone') }}
                    </p>
                @endif
                @if (config('mpcsuiblade.seo.email'))

                    <p class="mb-0">
                        <i class="mdi mdi-email"></i>
                        {{ config('mpcsuiblade.seo.email') }}
                    </p>
                @endif
                @if (config('mpcsuiblade.seo.address'))
                    <p>
                        <small>
                            <i class="mdi mdi-map-marker-circle"></i>
                            {{ config('mpcsuiblade.seo.address') }}
                        </small>
                    </p>
                @endif
            </div>
        </div>
    </div>
</header>
