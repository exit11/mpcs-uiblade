@extends(UiBlade::theme('app'))

{{-- app content --}}
@section('app_content')
    <div id="contentContainer" class="pt-4">
    </div>
@stop


{{-- 템플릿 스크립트 추가 --}}
@push('header_script')
    <script>

    </script>
@endpush

{{-- CURD 스크립트 추가 --}}
@push('after_app_scripts')
    <script>
        window.WEBAPP.ARTICLE();
    </script>
@endpush
