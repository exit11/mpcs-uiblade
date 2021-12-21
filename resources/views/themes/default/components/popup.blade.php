@if(!isset($_COOKIE["modalPopupHidden"]))
    @if($notiPopups->count() > 0)
        <div class="modal fade modal-popup" tabindex="-1" role="dialog" id="modalPopup" aria-hidden="true">
          <div class="modal-dialog m-auto" role="document" style="max-width: 420px">
            <div class="modal-content bg-transparent border-0 p-3">
              <div class="modal-header border-bottom-0 p-0">
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                  <i class="mdi mdi-close-circle-outline text-white h2"></i>
                </button>
              </div>
              <div class="modal-body p-0">                 
                    <div class="carousel slide" id="popupCarousel" data-ride="carousel">
                          <!-- Indicators -->
                          @if($notiPopups->count() > 1)
                          <ol class="carousel-indicators mb-2">
                           @foreach($notiPopups as $key => $item)
                            <li data-target="#popupCarousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                           @endforeach
                          </ol>
                          @endif
                           
                          <div class="carousel-inner" role="listbox">
                              @each($itemView, $notiPopups, 'item')
                          </div>
                    </div>
              </div>
              <div class="modal-footer border-top-0 p-0">
                  <button type="button" class="btn btn-dark btn-lg hidden-time btn-block m-0 mt-1">
                    <span aria-hidden="true">일주일 동안 보지 않기</span>
                  </button>
              </div>
            </div>
          </div>
        </div>

        @push('after_app_scripts')
          <script>
          $(function () {    
              $('#modalPopup').modal({
                  backdrop: 'static', 
                  keyboard: false,
                  show: true
              });
              $("#modalPopup .hidden-time").click(function() {
                  $("#modalPopup").modal('toggle');
                  Cookies.set("modalPopupHidden", "hidden", { expires: 7 });
              });
          })
          </script>  
        @endpush

    @endif
@endif