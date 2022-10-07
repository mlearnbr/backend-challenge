import loadDatatables from './load-datatables'
import loadMessages from './load-messages'
import loadLinks from './load-links'
import loadMasks from './load-masks'

$(document).ready(function () {
    loadDatatables()
    loadMessages()
    loadLinks()
    loadMasks()

    $('.select2').select2();
})
