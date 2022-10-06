export default (selector, mask, options = {}, useDefaultOptions = true) => {
    let defaultOptions = {
        placeholder: "_"
    };
    if(useDefaultOptions) {
        $.extend(options, defaultOptions);
    }
    $(selector).each(function () {
        if($.isArray(mask)) {
            $.extend(options, {mask: mask});
            $(this).inputmask(options);
        } else if ($.type(mask) === "string") {
            $(this).inputmask(mask, options);
        } else {
            $.extend(options, mask)
            $(this).inputmask(options);
        }
    });
};
