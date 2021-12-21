<div class="modal fade modal-crud" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title p-1">{{ $title ?? '생성/수정' }}</h5>
        <div class="">
          {{ $headerButtons ?? '' }}
          <button type="button" class="btn btn-icon btn-light align-middle" data-dismiss="modal" aria-label="Close">
            <i class="mdi mdi-close"></i>
          </button>
        </div>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
        {{ $footerButtons ?? '' }}
        <button type="submit" class="btn btn-primary">확인</button>
      </div>
    </div>
  </div>
</div>