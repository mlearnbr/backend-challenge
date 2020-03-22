var UsersManager = (function () {

    var usersTable = $("#usersTable");

    var _initUsers = function () {

        let settings = {

            pageSize : 10,
            locale : 'pt-BR',
            url : 'user/parse_index',
            dataType: 'json',
            method : 'get',
            contentType: 'application/x-www-form-urlencoded',
            queryParams: function (p) {
                var params = {};
                params.options = p;
                return params;
            },
            sidePagination: 'server',
            pageList : [10, 25, 50, 100],
            pagination: true,
            columns: [
                {
                    title: '#',
                    field: 'id',
                    sortName: 'Users.id',
                    sortable: false
                }, {
                    title: 'Nome',
                    field: 'name',
                    sortName: 'Users.name',
                    sortable: false
                }, {
                    title: 'Telefone',
                    field: 'celphone',
                    sortName: 'Users.celphone',
                    sortable: false
                }, {
                    title: 'Nível',
                    field: 'access_level',
                    sortName: 'Users.access_level',
                    sortable: false
                }, {
                    title: 'Ações',
                    field: 'actions',
                    events: {
                        'click .edit': (e, value, row, index) => {
                            _edit(row.id);
                        },
                        'click .remove': (e, value, row, index) => {
                            _delete(row.id);
                        }
                    }

                }
            ]
        };
        usersTable.bootstrapTable(settings);
    };

    var _edit = function (id) {

        var settings = {
            type: 'get',
            url: 'user/edit',
            data: {id: id}
        };

        $.ajax(settings)
            .done(function(data){
                $("#modal").html(data);
                $('#modalAddUsuario').modal();
            }).fail(function () {
                $.notify({message: 'Não foi possível executar essa ação no momento. Tente mais tarde'},{type: 'danger'});
            });
    };

    var _delete = function (id) {

        var settings = {
            type: 'get',
            url: 'user/delete',
            data: {id: id}
        };

        Swal.fire({
            title: "Você tem certeza?",
            text: "Este registro será permanentemente excluído!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim",
            cancelButtonText: "Não",
            showLoaderOnConfirm: true,
            preConfirm: function (isConfirm) {
                if (isConfirm) {
                    return $.ajax(settings)
                        .done( data => data)
                        .fail(data => data.responseJSON);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (data) {
            let res = data.value;
            Swal.fire({title: "", text: res.msg, icon: res.class}).then(function () {
                _updateTable();
            });
        });
    };

    var _initFrmEditUser = function (){

        let frmEditUser = $("#frmUser");
        let btnSaveUsuario = $("#btnSaveUsuario");

        var settingsAjaxForm = {
            dataType:  'json',
            beforeSubmit: function(arr, $form, options) {
                btnSaveUsuario.html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>");
                if(!frmEditUser.parsley().isValid()){
                    btnSaveUsuario.html("Salvar");
                }

                return frmEditUser.parsley().isValid();
            },
            success: function (data) {
                $('.modal').modal('hide');
                Swal.fire("", data.msg, data.class);
                btnSaveUsuario.html("Salvar");
                _updateTable();

            },
            error: function(data) {
                var res = data.responseJSON;
                Swal.fire("", res.msg, res.class);
                btnSaveUsuario.html("Salvar");
            }
        };

        frmEditUser.ajaxForm(settingsAjaxForm);
        frmEditUser.parsley();
    };

    var _updateTable = function (){
        usersTable.bootstrapTable('destroy');
        _initUsers();
    };

    return {
        init: _initUsers,
        initFrmEditUser: _initFrmEditUser,
        edit: _edit
    }
})();