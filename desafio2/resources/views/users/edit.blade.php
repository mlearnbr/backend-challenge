<div class="modal fade" id="modalAddUsuario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar/Editar Usuario</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                {{ Form::open(['url' => 'user/save', 'class'=>"", 'id' => 'frmUser']) }}
                {{ Form::hidden('id', isset($oUser) ? $oUser->id : '') }}
                    <div class="form-group">
                        {{ Form::text('name', isset($oUser) ? $oUser->name : null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required' => 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('celphone', isset($oUser) ? $oUser->celphone : null, ['class' => 'form-control phoneMask', 'placeholder' => 'Telefone Celular', 'required' => 'required']) }}
                    </div>
                <div class="form-group">
                    {{ Form::select('access_level',
                            \App\User::listOptionsAccessLevel(),
                            isset($oUser) ? $oUser->access_level : null,
                           ['class' => 'form-control', 'id' => 'access_level']
            ) }}
                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                <button class="btn btn-primary" id="btnSaveUsuario" type="button">Salvar</button></div>

        </div>
    </div>
</div>

<script src="{{asset('js/users/edit.js')}}" type="text/javascript"></script>