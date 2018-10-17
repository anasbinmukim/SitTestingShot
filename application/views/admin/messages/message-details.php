<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>

<?php 
	echo '<div class="message_reply">';
	echo '<div>'.html_entity_decode($message_data['msg_content']).'</div>';
 ?>
	<div class="date_time"><?php echo date('d M y h:i:sa', strtotime($message_data['msg_date'])); ?></div>
	</div>
<?php
	foreach($message_reply as $reply){
		echo '<div class="message_reply">';
		echo '<div class="reply_text">Reply from '.$reply->msg_author.':</div><div>'.$reply->msg_content.'</div>';
	?>
		<div class="date_time"><?php echo date('d M y h:i:sa', strtotime($reply->msg_date)); ?></div>			
	<?php
		echo '</div>';
	}
?> 
 
<form action="" method="post" enctype="multipart/form-data"> 
	<div class="row">
		<div class="col-md-12">
		  <div class="form-group">
			  <label class="control-label">Reply:</label>
			  <textarea class="form-control" name="msg_content"></textarea></div>		  
		  <div class="reply_btn">
			  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			  <input type="hidden" name="message_id" value="<?php echo $message_data['ID']; ?>">
			  <input type="submit" class="btn green" name="message_reply" value="REPLY">
		  </div>
		</div>
	</div>
</form> 