<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Messages</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/messages/register'); ?>">Register New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="district_editable_view">
                    <thead>
                        <tr>
                            <th> Date </th>
                            <th> Subject </th>
                            <th> Message</th>
                            <th width="50"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						$read_status = "";
						foreach ($message_rows as $message) { 
							if($message->read_status == 0){
								$read_status = "unread";
							}else{
								$read_status = "read";
							}
						?>		
						<tr class="<?php echo $read_status; ?>">
                              <?php
                                $message_slug = $message->msg_slug;	
								$content = strip_tags(html_entity_decode($message->msg_content));
								$content = substr($content,0,50);
                              ?>
                              <td><?php echo $message->msg_date; ?></td>
                              <td><a href="<?php echo site_url('admin/messages/details/'.$message_slug); ?>"><?php echo $message->msg_subject; ?></a></td>
							  <td><a href="<?php echo site_url('admin/messages/details/'.$message_slug); ?>"><?php echo $content; ?></a></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('admin/messages/details/'.$message_slug).'" title="View"><i class="fa fa-th-list"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this message?\');" href="'.site_url('admin/messages/delete/'.encrypt($message->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                        </tr>
                          
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>