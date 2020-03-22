var Common = (function () {

    var _buildParamsFilters = function (selector) {

        var params = [];
        $.each($(selector).find(':input'), function (index, value) {

            if (!$(value).is(':hidden')) {
                if ($(value).is(':checkbox')) {
                    if ($(value).prop('checked')) {
                        params.push($(value).attr('name') + '=' + $(value).prop('checked'))
                    }
                } else {
                    if ($(value).val() != '') {
                        params.push($(value).attr('name') + '=' + $(value).val())
                    }
                }
            }
        });

        if (params != '') {
            params = params.join('&');
            return params;
        }

        return '';

    }

    var _resetParamsFilters = function (selector) {

        $.each($(selector).find(':input'), function (index, value) {

            if ($(value).is(':checkbox')) {
                $(value).prop('checked', false);
            }

            if ($(value).val() != '') {
                $(value).val('');
            }
        });

        return '';

    };

    var _scrollTo = function (validator, delay) {

        if (!validator.numberOfInvalids())
            return;

        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top
        }, delay);
    };

    var _buildSuccessAlert = function(response, title = 'Bom trabalho!', msg = 'Permissões salvas com sucesso', redirectTo = null, autoClose = null)
    {
        if ( redirectTo === null ) {
            swal(
                title,
                msg,
                'success'
            );
        }
        else {
            var swalOpts = {
                    title: title,
                    html: msg,
                    type: 'success',
                    allowEscapeKey: false,
                    onOpen : function() {
                        $('html').removeClass('swal2-shown');
                        $('body').removeClass('swal2-shown');
                    },
                    allowOutsideClick: () => !swal.isLoading()
        };

        if ( autoClose !== false ) {
            swalOpts.onOpen = () => {
                swal.showLoading()
            };

            swalOpts.timer = 3000;
        }

        swal(swalOpts).then((result) => {
            window.location.href = redirectTo;
    });
}
}

var _buildSimpleError = function(title, msg)
{
    var swalOpts =
        {
            title: title,
            html: msg,
            type: 'error',
            allowEscapeKey: false,
            onOpen : function() {
                $('html').removeClass('swal2-shown');
                $('body').removeClass('swal2-shown');
            },
            allowOutsideClick: () => !swal.isLoading()
};

swal(swalOpts).then((result) => {});
};

var _buildErrorAlert = function (response, title ) {

    if ("errors" in response) {

        var errorList = '';

        $(response.errors).each(function (index, element) {
            errorList += element.message;
        })

        swal({
            type: 'error',
            title: title,
            text: errorList,
            onOpen : function() {
                $('html').removeClass('swal2-shown');
                $('body').removeClass('swal2-shown');
            }
        });

    }
};

var _buildInfoAlert = function(title, msg, redirectTo = null, autoClose = null)
{
    if ( redirectTo === null )
    {
        swal(title, msg, 'info');
    }
    else
    {
        var swalOpts =
            {
                title: title,
                html: msg,
                type: 'info',
                allowEscapeKey: false,
                onOpen : function() {
                    $('html').removeClass('swal2-shown');
                    $('body').removeClass('swal2-shown');
                },
                allowOutsideClick: () => !swal.isLoading()
    };

    if ( autoClose !== false )
    {
        swalOpts.onOpen = () => { swal.showLoading() };
        swalOpts.timer = 4000;
    }

    swal(swalOpts).then((result) => { window.location.href = redirectTo; });
}
}


var _buildConfirmAlert = function(yesCallback, title) {
    swal({
        title: title,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Confirmar',
        cancelButtonText: "Cancelar"
    })
        .then((result) => {
        if (result.value) {
        yesCallback();
    }
});
};

var _initPassWordValidation = function(inputPassword){

    var options = {};
    options.ui = {
        container: "#pwd-container",
        showStatus: true,
        showVerdicts: false,
        showProgressBar: false,
        viewports: {
            verdict: ".pwstrength_viewport_verdict"
        },
        showPopover: false,
        showErrors: true,
        spanError: function (options, key) {
            var text = options.i18n.t(key);
            if (!text) { return ''; }
            return '<span style="color: #d52929">' + text + '</span>';
        }
    };

    options.rules = {
        activated: {
            wordOneSpecialChar: true,
            wordSequences: true,
            wordNotEmail: false,
            wordIsACommonPassword: true
        },
        commonPasswords: [
            'sirio123',
            '123sirio',
            'abc123sirio',
            'sirioabc123',
            'hsl123',
            '123hsl',
            'siriolibanes123',
            '123siriolibanes'
        ]
    };

    options.common = {
        minChar: 8,
        onKeyUp: function(){
            var rules = _getRulesStatus(inputPassword);
            if(_checkPasswordRules(inputPassword)){
                $.each(rules, function(index, value){
                    if(!value){
                        $(".error-list").html("");
                    }
                });
            }
        },
        onScore: function (options, word, totalScoreCalculated) {
            if(_checkPasswordRules(inputPassword)){
                totalScoreCalculated = 100;
            }
            return totalScoreCalculated;
        }
    };

    i18next.init({
        lng: 'pt',
        resources: {
            pt: {
                translation: {
                    "wordMinLength": "A senha deverá ter, pelo menos, 8 caracteres",
                    "wordMaxLength": "Sua senha é muito longa",
                    "wordInvalidChar": "Sua senha contém um caractere inválido",
                    "wordNotEmail": "Não use seu e-mail como senha",
                    "wordSimilarToUsername": "Sua senha não pode conter o seu nome de usuário",
                    "wordTwoCharacterClasses": "Use diferentes classes de caracteres",
                    "wordRepetitions": "Muitas repetições",
                    "wordSequences": "Sua senha contém sequências",
                    "errorList": "Erros:",
                    "veryWeak": "Muito Fraca",
                    "weak": "Fraca",
                    "normal": "Normal",
                    "medium": "Média",
                    "strong": "Forte",
                    "veryStrong": "Muito Forte",
                    "wordUppercase": "Informe pelo menos uma letra maiúscula",
                    "wordLowercase": "Informe pelo menos uma letra minúscula",
                    "wordOneSpecialChar": "Informe pelo menos um caracter especial (!, @, #, entre outros)",
                    "wordOneNumber": "Informe pelo menos um número",
                    "wordIsACommonPassword": "Senha não permitida"
                }
            }
        }
    }, function () {

        inputPassword.pwstrength(options);
    });

};

var _getRulesStatus = function(inputPassword){
    return {
        "wordUppercase": inputPassword.pwstrength("ruleIsMet", "wordUppercase"),
        "wordLowercase": inputPassword.pwstrength("ruleIsMet", "wordLowercase"),
        "wordOneNumber": inputPassword.pwstrength("ruleIsMet", "wordOneNumber"),
        "wordOneSpecialChar": inputPassword.pwstrength("ruleIsMet", "wordOneSpecialChar")
    };

};

var _checkRulesIsMet = function(inputPassword){

    var checkRules = _getRulesStatus(inputPassword);

    var contRulesCheck = 0;

    $.each(checkRules, function(index, value){
        contRulesCheck += value ? 1 : 0;

    });

    return contRulesCheck;
};

var _checkPasswordRules = function(inputPassword){

    return _checkRulesIsMet(inputPassword) > 2 && inputPassword.pwstrength("ruleIsMet", "wordMinLength");
};

var _redirectToLogin = function() {
    window.location.href = '/'
}

return {
    buildParamsFilters: _buildParamsFilters,
    resetParamsFilters: _resetParamsFilters,
    scrollTo: _scrollTo,
    buildSuccessAlert: _buildSuccessAlert,
    buildErrorAlert: _buildErrorAlert,
    buildSimpleError: _buildSimpleError,
    buildInfoAlert: _buildInfoAlert,
    buildConfirmAlert: _buildConfirmAlert,
    initPassWordValidation: _initPassWordValidation,
    checkPasswordRules: _checkPasswordRules,
    redirectToLogin : _redirectToLogin
}
})();
