import DataTable from './datatable'

export default () => {
    $(".datatable").each(function() {
        new DataTable($(this), JSON.parse($(this).attr('config'))).start()
    })
}
