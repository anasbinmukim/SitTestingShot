<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>

<?php 
	echo '<div class="notification_details">';
	foreach($notification_info as $notification){
		echo '<div class="notif_text">Notification from '.$notification->last_name.':</div>';			
	}
	echo '<div>'.html_entity_decode($notification_data['description']).'</div>';
 ?>
	<div class="date_time"><?php echo date('d M y h:i:sa', strtotime($notification_data['create_date'])); ?></div>
	</div>
 