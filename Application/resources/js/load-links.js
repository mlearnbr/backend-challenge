import LinkMethod from './link-method'

export default () => {
    $('a[method]').each((index, el) => {
        let linkMethod = new LinkMethod($(el))
        $(el).click(linkMethod.handleClick)
    })
}
