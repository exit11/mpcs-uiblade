<header class="page-wrapper--header">
    <div class="page-wrapper--header__container bg-primary"
        style="background-image:url({{ UiBlade::setHeaderImage() }});">
        {{-- 헤더 이미지 --}}
        <div class="page-wrapper--header__container_inner">
            <nav class="d-flex align-items-center justify-content-between">
                <div class="nav-header--main">
                    <button
                        class="btn btn-icon {{ config('mpcsuiblade.sns.color_class_name') ? 'text-' . config('mpcsuiblade.sns.color_class_name') : 'text-white' }}"
                        type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav"
                        aria-controls="offcanvasNav">
                        <i class="mdi mdi-menu md-24"></i>
                    </button>
                </div>
                <div class="btn-group-sns me-3">

                    @if (config('mpcsuiblade.sns'))
                        @forelse (config('mpcsuiblade.sns') as $name => $item)
                            <a href="{{ $item['url'] }}" target="_blank"
                                class="btn btn-icon px-2 {{ $item['color'] }}">
                                <i class="mdi mdi-{{ $name }} md-18"></i>
                            </a>
                        @empty
                        @endforelse
                    @endif

                    {{-- <a href="#" class="btn btn-sm btn-light">
                        <i class="mdi mdi-account"></i> 로그인
                    </a> --}}
                </div>
            </nav>

            <div class="text-center">
                @if (config('mpcsuiblade.header_slogun'))
                    @forelse (config('mpcsuiblade.header_slogun') as $item)
                        @switch($item['type'])
                            @case('text')
                                <p class="{{ implode(' ', $item['className']) }}">
                                    {{ $item['content'] }}
                                </p>
                            @break
                            @default
                        @endswitch
                        @empty
                        @endforelse
                    @endif
                </div>
                <div class="pt-5 pb-4 wow animate__animated animate__fadeInUp text-center text-white">
                    @if (config('mpcsuiblade.seo.phone.enable_page'))
                        <p class="mb-0">
                            <i class="mdi mdi-phone"></i>
                            {{ config('mpcsuiblade.seo.phone.data') }}
                        </p>
                    @endif
                    @if (config('mpcsuiblade.seo.email.enable_page'))
                        <p class="mb-0">
                            <i class="mdi mdi-email"></i>
                            {{ config('mpcsuiblade.seo.email.data') }}
                        </p>
                    @endif
                    @if (config('mpcsuiblade.seo.address.enable_page'))
                        <p class="mb-0">
                            <small>
                                <i class="mdi mdi-map-marker-circle"></i>
                                {{ config('mpcsuiblade.seo.address.data') }}
                            </small>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </header>
