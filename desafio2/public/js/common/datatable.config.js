
var DatatableConfig = (function () {

    var datatable;

    var _datatable = function (params) {
console.log(params);
        return $(params.selector).DataTable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: params.datatableUrl,
                        method: 'GET',
                        // custom headers
                        params: {
                            // custom query params
                            query: {}
                        },
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                saveState: {
                    cookie: false,
                    webstorage: false
                },
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            },

            // layout definition
            layout: {
                theme: 'default',
                class: '',
                scroll: false,
                footer: false
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch')
            },

            // columns definition
            columns: params.dataTableColumns,

            translate: {
                records: {
                    processing: 'Por favor aguarde...',
                    noRecords: 'Nenhum registro encontrado'
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: 'Primeiro',
                                prev: 'Anterior',
                                next: 'Próximo',
                                last: 'Último',
                                more: 'Mais páginas',
                                input: 'Número da página',
                                select: 'Selecione o tamanho da página'
                            },
                            info: 'Exibindo {{start}} - {{end}} de {{total}} registros'
                        }
                    }
                }
            }
        });
    };

    var _filter = function (query) {
        datatable.setDataSourceQuery(query);
        datatable.setDataSourceParam('pagination.page', 1);
        datatable.spinnerCallback(true);
        datatable.load();
    };

    return {
        // public functions
        init: function (params) {
            datatable = _datatable(params);
        },
        filter: function(query) {
            _filter(query);
        }
    };

})();