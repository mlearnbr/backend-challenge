export default (type, message, confirmCallback) => {
    let messageBtn = null
    let buttons = []

    if (message.search('<a href=') !== -1) {
        messageBtn = message.slice(message.search('<a href='))
        message = message.slice(0, message.search('<a href=') - 1)
    }

    if (messageBtn) {
        buttons = [[messageBtn, () => window.location.href = $(messageBtn).attr('href'), true]]
    }

    switch (type) {
        case 'info':
            iziToast.info({
                message: message,
                position: 'topRight',
                buttons: buttons,
                closeOnClick: true,
                transitionIn: 'fadeInLeft'
            })
            break

        case 'warning':
            iziToast.warning({
                title: 'Cuidado',
                message: message,
                position: 'topRight',
                buttons: buttons,
                closeOnClick: true,
                transitionIn: 'fadeInLeft'
            })
            break

        case 'success':
            iziToast.success({
                title: 'Sucesso',
                message: message,
                position: 'topRight',
                buttons: buttons,
                closeOnClick: true,
                transitionIn: 'fadeInLeft'
            })
            break
        case 'confirm':
            iziToast.question({
                timeout: false,
                overlayClose: true,
                close: false,
                drag: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                message: message,
                position: 'center',
                buttons: [
                    [`<button>Sim</button>`, function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'confirm')

                    }, true],
                    [`<button>Não</button>`, function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'cancel')

                    }],
                ],
                onClosing: function(instance, toast, closedBy){
                    if (closedBy === 'confirm') {
                        confirmCallback()
                    }
                }
            })
            break
        case 'danger':
        case 'error':
            iziToast.error({
                title: 'Erro',
                message: message,
                position: 'topRight',
                buttons: buttons,
                closeOnClick: true,
                transitionIn: 'fadeInLeft'
            })
            break
    }
}
