@extends($protoTypePath.'.layouts.app')

{{-- app content --}}
@section('app_content')

<div class="crud-wrap container-fluid mt-3">

    {{-- Sub Header --}}
    <div class="row align-items-start justify-content-between">
        <div class="col">
            <h2>@yield('crud_subtitle')</h2>
        </div>
        <div class="col text-right">
            {{-- Crud 헤더 버튼 그룹 --}}
            @hasSection('crud_button_group')
            @yield('crud_button_group')
            @endif
        </div>
    </div>

    <div class="row">
        @if(View::hasSection('aside_left_nav') || View::hasSection('crud_search'))
        <div class="col-12 col-xl-3">

            {{-- 왼편 사이드 네비게이션 --}}
            @hasSection('aside_left_nav')
            @yield('aside_left_nav')
            @endif

            {{-- 검색 폼 --}}
            @hasSection('crud_search')
            @yield('crud_search')
            @endif

        </div>
        @endif

        <div class="col">
            <div class="panel-wrap mb-2">
                <div class="panel-heading d-flex align-items-start justify-content-between">
                    <h4 class="h4">@yield('crud_list_title')</h4>

                    {{-- 그리드 버튼 그룹 --}}
                    @hasSection('crud_grid_button_group')
                    @yield('crud_grid_button_group')
                    @endif

                </div>
                <div class="panel-body">

                    {{-- 목록 그리드 --}}
                    <div class="crud-grid">
                        @yield('crud_grid')
                    </div>

                    @isset($models)
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $models->render("pagination::bootstrap-4") }}
                    </div>
                    @endisset

                </div>
            </div>
        </div>
    </div>


    {{-- 생성,수정 모달 폼 컴포넌트 --}}
    @hasSection('crud_form')
    @yield('crud_form')
    @endif


</div>

@stop