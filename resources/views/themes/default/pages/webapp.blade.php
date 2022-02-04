@extends(UiBlade::theme('app'))

{{-- app content --}}
@section('app_content')
@stop


{{-- 템플릿 스크립트 추가 --}}
@push('header_script')
    <script>

    </script>
@endpush

{{-- CURD 스크립트 추가 --}}
@push('after_app_scripts')
    <script>
        @if ($webapp['name'])
            window.WEBAPP.{{ $webapp['name'] }}("{{ $webapp['container_id'] ?? 'contentContainer' }}",
            @json($webapp['options']));
        @endif
    </script>
@endpush
