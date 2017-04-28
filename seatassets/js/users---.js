$(document).ready(function(){

	var grid = new Datatable();

	grid.init({
		src: $("#users-tbl"),
		onSuccess: function (grid, response) {
			// grid:        grid object
			// response:    json object of server side ajax response
			// execute some code after table records loaded
		},
		onError: function (grid) {
			// execute some code on network or other general error
		},
		onDataLoad: function(grid) {
			// execute some code on ajax data load
		},
		loadingMessage: 'Loading...',
		dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options
			"processing": true,
			"serverSide": true,
			select: true,
			"ajax": {
				"url": $("#users-tbl").data('url')
			},
			"order": [
				[1, "asc"]
			],
			"colReorder": {
                reorderCallback: function () {
                    console.log( 'callback' );
                }
            },
			buttons: [
				{ className: 'btn red', text: 'New User', action: function ( e, dt, node, config ) { window.location.href = site_url+'admin/users/create'  } },

			],
			"dom": "<'row cw-listactions'<'col-xs-6'f><'col-xs-6'B>><'table-scrollable'rt><'row cw-listnav'<'col-xs-6'il><'col-xs-6'p>>",
			"pagingType": "bootstrap_number",
			"language": { // language settings
				"info": "Found total _TOTAL_ records",
				"search": "Search Users: ",
			},
			"columnDefs": [
				{"className": "text-center", "targets": [6]},
				{"className": "text-left", "targets": "_all"},
				{ orderable: false, targets: 0 },
			],
			"lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
			"pageLength": 20,
		}
	});

	grid.setAjaxParam("customActionType", "group_action");
	grid.getDataTable().ajax.reload();
	grid.clearAjaxParams();




	$('.date-picker_created').datetimepicker({
		format: 'MM/DD/YYYY',
		icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'glyphicon glyphicon-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		}
	});

	$(document).on('click', '.user-delete', function() {
		var $this = $(this);
		var choice = confirm('Do you really want to delete this user?');
		if(choice === true) {
		   $.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
		   $.ajax({
					type: 'POST',
					url: $this.data('url'),
					data:{},
					success: function(data){
						grid.getDataTable().ajax.reload();
						$.unblockUI();
					}
				});

		}
		return false;
	});

	$(document).on('click', '.user-reinvite', function() {
		var $this = $(this);
		$.blockUI({ message: '<h1><img src="'+base_url+'/assets/global/img/loading-spinner-blue.gif" /> Just a moment...</h1>' });
		$.ajax({
				type: 'POST',
				url: $this.data('url'),
				data:{},
				success: function(data){
					$.unblockUI();
				}
			});
	});

});

$(document).on('change', '#group_id', function() {

 	var $group_id = $('#group_id').val();

 	if ( $group_id == 3 ) {
 		$( ".opt" ).removeClass( "hidden" );
 	} else if ( $group_id == 2 ) {
 		$( ".opt" ).addClass( "hidden" );
 		$( ".first" ).removeClass( "hidden" );
 	} else {
 		$( ".opt" ).addClass( "hidden" );
 	}

});
