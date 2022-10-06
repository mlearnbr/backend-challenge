import flashMessage from './flash-messages'

class LinkMethod {
    constructor(el) {
        this.el = el
        this.handleClick = this.handleClick.bind(this)
    }

    handleClick(e) {
        e.preventDefault();

        var submitForm = () => {
            let form = this.form()
            form.submit()
        }

        if (this.el.is('[message]')) {
            flashMessage('confirm', this.el.attr('message'), submitForm)
        } else {
            submitForm()
        }
    }

    form() {
        let form = $('<form>', {
            method: 'POST',
            action: this.el.attr('href')
        })

        form.append($('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': $('meta[name="csrf-token"]').attr('content')
        }))

        form.append($('<input>', {
            'name': '_method',
            'type': 'hidden',
            'value': this.el.attr('method')
        }))

        return form.appendTo('body')
    }
}

export default LinkMethod
