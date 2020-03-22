$(document).ready(function () {

    UsersManager.init();

    $('#btFilter, #btClearFilter').on('click', function(event) {

        var selector = '.filter-users';

        if ($(this).attr('id') == "btClearFilter") {
            Common.resetParamsFilters(selector);
            DatatableConfig.filter(Common.buildParamsFilters(selector));
        } else {
            DatatableConfig.filter(Common.buildParamsFilters(selector))
        }

        event.preventDefault();
    });
});