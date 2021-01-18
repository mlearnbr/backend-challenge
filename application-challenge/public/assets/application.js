$(document).ready(function (){
    $('#btnSave').click(function () {

        if(isFieldsFilled()) return;

        var data = $('#signupForm').serialize();

        $('#btnSave').attr('disabled', true);

        $.ajax({
            url: 'api/user/signup',
            data: data,
            method: "post",
            success: function(data) {
                console.log(data);
                $.confirm({
                    boxWidth: '50%',
                    useBootstrap: false,
                    title: 'USUÁRIO CADASTRADO COM SUCESSO',
                    content: '',
                    type: 'blue',
                    typeAnimated: true,
                    buttons: {
                        ok: {
                            text: 'Ok',
                            btnClass: 'btn-blue',
                            action: function () {
                                location.reload();
                            }
                        },
                    }
                });
            }
        });
    });

    function isFieldsFilled()
    {
        if($('#msisdn').val().length === 0 || $('#access_level').val().length === 0 || $('#name').val().length === 0 || $('#password').val().length === 0) {
            $.dialog({
                title: '',
                content: 'Todos campos são de preenchimento obrigatório!',
                type: 'red',
            });            
            return true
        }
        return false
    }

    $('.btnUser').click(function () {
        var userId = $(this).data('userid')
        var action = $(this).data('action')
        var url = 'api/user/down'
        if(action === 'up') {
            url = 'api/user/up'
        }

        $.ajax({
            url: url + '/' + userId,
            method: "put",
            success: function() {
                $.confirm({
                    boxWidth: '50%',
                    useBootstrap: false,
                    title: 'ALTERAÇÃO REALIZADA COM SUCESSO',
                    content: '',
                    type: 'green',
                    typeAnimated: true,
                    buttons: {
                        ok: {
                            text: 'Ok',
                            btnClass: 'btn-green',
                            action: function () {
                                location.reload();
                            }
                        },
                    }
                });
            }
        });
    })
})