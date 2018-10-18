<form action="<?php echo base_url('admin/test/test_search');?>" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Search</label>
			<input type="text" name="search_msg" class="form-control" value="" /> </div>                                                                     		 
	  <div class="margin-top-10">
		  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		  <input type="submit" class="btn green" name="search_btn" value="Search">
	  </div>
  </div>
</div>
</form>


<table class="table table-striped table-hover table-bordered" id="message_view">
	<thead>
		<tr>
			<th> ID </th>
			<th> Subject </th>
			<th> Message</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($message_data as $message) { 							
		?>		
		<tr>                            
			  <td><?php echo $message->ID; ?></td>                              
			  <td><?php echo $message->msg_subject; ?></td>
			  <td><?php echo $message->msg_content; ?></td>
			  
		</tr>                          
		<?php } ?>
	</tbody>
</table>