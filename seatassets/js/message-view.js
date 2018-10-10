var TableMessageEditable = function () {

    var handleTable = function () {

        

        var table = $('#message_view123');

        var oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [10, 20, 30, -1],
                [10, 20, 30, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 20,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0,1]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "desc"]
            ] // set first column as a default sort by asc
        });
 
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableMessageEditable.init();
});

$(document).ready(function() {
    $('#message_view').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "http://bdsbooking.com/admin/messages"
    } );
} );





