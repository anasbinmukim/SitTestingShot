<?php
//require_once(FCPATH.'/application/views/breadcrumb.php');
//require_once(FCPATH.'/application/views/success-error-message.php');
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<body>
    <h1>Book List</h1>
	<table id="book-table" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<td>Book Title</td>
				<td>Book Price</td>
				<td>Book Author</td>
				<td>Rating</td>
			</tr>
		</thead>
		<tbody>
			<?php ?>
			<tr></tr>
		</tbody>
	</table>
	
	
	
	
<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable({
		"processing": true,
        "serverSide": true,
		"pageLength" : 5,
		"order": [
          [1, "desc" ]
        ],
		"ajax": {
            url : "<?php echo site_url("admin/test/books_page") ?>",
            type : 'GET'
        },
	});
});
</script>	
</body>