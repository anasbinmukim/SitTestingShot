<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>

<?php 
	echo html_entity_decode($message_data['msg_content']);
 ?>
 <p style="text-align: right;"><?php echo $message_data['msg_date']; ?></p>

<?php
	$count = 1;
	foreach($message_reply as $reply){		
		echo '<p>Reply '.$count.':<br>'.$reply->msg_content.'</p>';
		$count++;
	?>
	<p style="text-align: right;"><?php echo $reply->msg_date; ?></p>
	<?php	
	}
?> 
 
<form action="" method="post" enctype="multipart/form-data"> 
	<div class="row">
		<div class="col-md-12">
		  <div class="form-group">
			  <label class="control-label">Reply:</label>
			  <textarea class="form-control" name="msg_content"></textarea></div>		  
		  <div class="margin-top-10">
			  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			  <input type="hidden" name="message_id" value="<?php echo $message_data['ID']; ?>">
			  <input type="submit" class="btn green" name="message_reply" value="REPLY">
		  </div>
		</div>
	</div>
</form> 