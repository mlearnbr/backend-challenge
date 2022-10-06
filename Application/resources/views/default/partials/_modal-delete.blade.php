@modal(['type'=>'danger', 'class' => 'modal-delete', 'title'=> __('messages.delete_modal_title')])
    {{ __('messages.delete_modal_content') }}
    @slot('options')
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times"></i> {{ __('options.cancel') }}</button>
        <button type="button" class="btn btn-outline btn-submit"><i class="fa fa-check"></i> {{__('options.confirm')}}</button>
    @endslot
@endmodal
