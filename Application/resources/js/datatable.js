import LinkMethod from './link-method'

const datatable_tranlation = {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "Mostrar _MENU_ por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}

const datatable_config = {
    language: datatable_tranlation,
    dom: 'l<"dt-search">rtip',
    responsive: true,
    processing: true,
    autoWidth: false,
    serverSide: true,
    order: []
}

class DataTable {
    constructor(datatableDiv, config = {}) {
        this.datatableDiv = datatableDiv
        this.table = this.datatableDiv.find('.dt-table')
        this.config = $.extend(true, {}, config, datatable_config)
    }

    start() {
        let url = this.table.attr('url')
        this.config.ajax = {
            url: url
        }

        this.columns()
        this.rows()
        this.responsive()

        let datatable = $(this.table).dataTable(this.config)

        this.search(datatable)

        return datatable
    }

    columns() {
        this.config.columns = $.map(this.table.find("th[column-data], th[actions]"), (el) => {
            return {
                data: $(el).attr("column-data") || null,
                name: $(el).attr("column-name") || null,
                width: $(el).attr("column-width"),
                className: $(el).attr("column-class"),
                orderable: !$(el).is("[unorderable], [actions]"),
                searchable: !$(el).is("[unsearchable], [actions]"),
                visible: !$(el).is("[invisible]")
            }
        })
    }

    rows() {
        this.config.fnCreatedRow = (row, data) => {
            let actions = this.table.find("th[actions]")
            if (actions.length) {
                let links = actions.data('links')
                let div = $('<div class="options-container"></div>')
                links.forEach((action) => {
                    div.append(this.button(action, data))
                })
                $(row).find(`td:eq(${actions.index()})`)
                    .empty()
                    .append(div)
            }

            this.options(row, this.table.find("th[checkbox]"), (parameter_name) => {
                return this.input(parameter_name, 'checkbox', data['id'])
            })

            this.options(row, this.table.find("th[radio]"), (parameter_name) => {
                return this.input(parameter_name, 'radio', data['id'])
            })
        }
    }

    responsive() {
        this.config.responsive = {
            details: {
                renderer: (api, rowIdx, columns) => {
                    let table = $('<table/>').addClass('dt-sub-table')

                    columns.forEach((col) => {
                        if (col.hidden) {
                            let value = $('<td/>').text(col.data)
                            let tableTh = this.table.find(`thead > tr > th:eq(${col.columnIndex})`)

                            if (tableTh.is('[actions]')) {
                                value = $('<td class="options-container"></td>')
                                tableTh.data('links').forEach((action) => {
                                    value.append(this.button(action, col.data))
                                })
                            }

                            let tr = $('<tr/>').data('dt-row', col.rowIndex)
                                .data('dt-column', col.columnIndex)
                                .append($('<td/>').text(`${col.title}:`))
                                .append(value)

                            table.append(tr)
                        }
                    })

                    return table.is(':parent') ? table : false
                }
            }
        }
    }

    search(datatable) {
        let searchInput = $('<input/>', {
            class: 'dt-search-input form-control form-control-sm',
            placeholder: 'Pesquisar'
        })

        let searchBtn = $('<button/>', {
            class: 'dt-search-btn btn btn-sm btn-outline-primary',
            type: 'button'
        }).append($('<i/>', { class: 'fa fa-search' }))

        this.datatableDiv.find('.dt-search')
            .addClass('input-group')
            .append(searchInput)
            .append($('<div/>', {
                class: 'input-group-append'
            }).append(searchBtn))

        searchBtn.click(() => {
            datatable.fnFilter(searchInput.val())
        })

        searchInput.keypress(function (e) {
            if (e.which === 13) {
                e.preventDefault()
                datatable.fnFilter($(this).val())
            }
        })
    }

    button(action, data) {
        let elem

        if (action.element == 'button') {
            elem = $(`<button title="${action.title}"></button>`)
                .attr('class', (action.class ?? '')+' btn btn-link p-0' || '')
        }
        else {
            elem = $(`<a title="${action.title}"></a>`)
                .attr('href', this.processURL(action.url, data) || '#')
                .attr('class', (action.class ?? '')+' btn btn-link p-0' || '')
        }

        Object.entries(action.options ?? []).forEach(([key, val]) => {
            elem.attr(key, val)
        })

        elem.append($(`<i class="fa ${action.icon} m-1"></i>`))
            .tooltip()

        if(action.method) {
            elem.attr('method', action.method)

            if (action.message) {
                elem.attr('message', this.replaceMatch(action.message, data))
            }

            let linkMethod = new LinkMethod(elem)
            elem.click(linkMethod.handleClick)
        }

        return elem
    }

    input(name, type = 'text', value = '') {
        return $(`<input type="${type}" name="${name}" value="${value}">`)
    }

    options(row, toMap, callback) {
        $.map(toMap, (th) => {
            let name = $(th).attr('column-data')
            let index = $(th).index()
            let option = callback(name, th)

            $(row)
                .find(`td:eq(${index})`)
                .empty()
                .append(option)
        })
    }

    processURL(url, data) {
        if (!url) {
            return false
        }
        url = decodeURIComponent(url)
        return this.replaceMatch(url, data)
    }

    replaceMatch(text, data) {
        let match = text.match(/\(([^)]+)\)/g)
        if (match) {
            for (let el of match) {
                let attr = el.substring(1, el.length - 1)
                if (_.get(data, attr) === undefined) {
                    return false
                }
                text = text.replace(`(${attr})`, _.get(data, attr))
            }
        }
        return text
    }
}

export default DataTable
