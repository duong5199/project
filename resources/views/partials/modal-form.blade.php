<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="base-form">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="card-body">
                        {!! $form_html ?? '' !!}
                    </div>

                    <div class="card-footer">

                        <button type="submit" class="btn btn-primary float-right">Lưu</button>
                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Đóng</button>

                    </div>
                </form>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
