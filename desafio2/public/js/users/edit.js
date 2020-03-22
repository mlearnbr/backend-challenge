$(document).ready(function () {
    UsersManager.initFrmEditUser();

    $("#btnSaveUsuario").on('click', function () {
        $("#frmUser").submit();
    });

    var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {onKeyPress: function(val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
        };

    $('.phoneMask').mask(maskBehavior, options);
});