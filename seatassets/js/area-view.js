$(document).ready(function(){
	var grid = new Datatable();
	var areaDataToPost = {
			csrf_bruite_check: csrf_value
	};

	grid.init({
		src: $("#area-tb1"),
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
				"url": $("#area-tb1").data('url'),
				"data":areaDataToPost
			},
			"order": [
				[1, "desc"]
			],
			"colReorder": {
                reorderCallback: function () {
                    console.log( 'callback' );
                }
            },
			oLanguage: {          
				sProcessing: "<img src='"+base_url+"assets/global/img/loading-spinner-blue.gif' />",
			},
			buttons: [],
			"dom": "<'row cw-listactions'<'col-xs-12'f><'col-xs-12'B>><'table-scrollable'rt><'row cw-listnav'<'col-xs-6'il><'col-xs-6'p>>",
			"pagingType": "bootstrap_number",
			"language": { // language settings
				"info": "Found total _TOTAL_ records",
				"search": "Search Messages: ",
			},
			"columnDefs": [
				{ orderable: false, targets: 0 },
			],
			"lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
			"pageLength": 20,
		}
	});

	grid.setAjaxParam("csrf_bruite_check", csrf_value);
	grid.setAjaxParam("customActionType", "group_action");
	grid.getDataTable().ajax.reload();
	grid.clearAjaxParams();

});
