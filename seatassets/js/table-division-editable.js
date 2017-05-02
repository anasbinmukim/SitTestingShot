var TableDivisionEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[0].innerHTML = '<input type="text" name="division_name" class="form-control division_name input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a class="edit" data-action_type = "update" href="">Save</a>';
            jqTds[2].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#division_editable_view');

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
                'orderable': false,
                'targets': [1,2]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#division_editable_view_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#division_editable_view_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
          e.preventDefault();
      		var $this = $(this);
      		var choice = confirm('Do you really want to delete this Division?');
      		if(choice === true) {
             var dataToPost = {
                 row_id: $this.data('division_id'),
                 db_table: $this.data('db_table'),
                 action_type: $this.data('action_type'),
                 csrf_bruite_check: csrf_value
             };
             $.ajax({
                 type: "POST",
                 dataType: "json",
                 url: $("#division_editable_view").data('url'),
                 data: dataToPost,
                 beforeSubmit: function() {
                     //jQuery('#division_editable_view').innerHTML('Sending...');
                 },
      					 success: function(data){
                  var nRow = $this.parents('tr')[0];
                  oTable.fnDeleteRow(nRow);
                  alert(data.msg);
      					}
      				});

      		}
      		return false;
      	});

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });


        table.on('click', '.edit', function (e) {
            e.preventDefault();
            nNew = false;
            var $this = $(this);
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                var dataToPost = {
                    row_id: $(this).parents('tr').find('.division_id').val(),
                    db_table: $(this).parents('tr').find('.db_table').val(),
                    division_name: $(this).parents('tr').find('.division_name').val(),
                    action_type: $this.data('action_type'),
                    csrf_bruite_check: csrf_value
                };
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: $("#division_editable_view").data('url'),
                    data: dataToPost,
                    beforeSubmit: function() {
                        //jQuery('#division_editable_view').innerHTML('Sending...');
                    },
         					 success: function(data){
                     //console.log(data);
                     saveRow(oTable, nEditing);
                     nEditing = null;
                     alert(data.msg);
         					}
         				});
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                nEditing = nRow;
            }
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
    TableDivisionEditable.init();
});
