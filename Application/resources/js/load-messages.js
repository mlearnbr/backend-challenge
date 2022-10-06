import flashMessages from './flash-messages'

export default () => {
    $('[data-messages]').each(function () {
        var messages = $(this).data('messages')

        if (!messages) {
            var type = $(this).data('type')
            var message = $(this).data('message')

            flashMessages(type, message)
        } else {
            messages.forEach((message) => {
                flashMessages(message.level, message.message)
            })
        }
    })
}
