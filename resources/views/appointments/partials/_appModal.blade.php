<div class="modal fade" tabindex="-1" role="dialog" id="appModal">
    <div class="modal-dialog" role="document">
        <form  id="appForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="mr-1 fa"></i>
                        <span class="ls-1"></span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="appForm">
                    <div class="modal-body">
                        @include('appointments.partials._appForm')
                    </div>
                    <div class="modal-footer flex">
                        <div class="flex-1">
                            <button type="button" class="btn app-button"></button>
                            <button type="button" class="btn btn-danger cancel-button" data-dismiss="modal" id="deleteApp">Cancel</button>
                        </div>
                        <div>
                            <button type="button" class="btn pull-left close-button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->