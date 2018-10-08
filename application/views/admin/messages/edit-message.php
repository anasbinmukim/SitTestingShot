<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Message</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
                                        <label class="control-label">Message Subject</label>
                                        <input type="text" name="msg_subject" class="form-control" value="<?php echo html_escape($message_data['msg_subject']); ?>" /> </div>
								</div>
							</div>
                            <div class="row">       
                              <div class="col-md-12">								
                                  <div class="form-group">
                                      <label class="control-label">Message Content</label>
                                      <textarea class="form-control ckeditor" name="msg_content"><?php echo html_entity_decode($message_data['msg_content']); ?></textarea></div>
									  <div class="form-group">
                                        <label class="control-label">Message Excerpt</label>
                                        <textarea class="form-control" name="msg_excerpt"> <?php echo html_escape($message_data['msg_excerpt']); ?> </textarea></div>
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="hidden" name="update_message_id" value="<?php echo $message_data['ID']; ?>">
                                      <input type="submit" class="btn green" name="update_message" value="Update Now">
                                  </div>
                              </div>
                            </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
		</div>
      <!-- END PROFILE CONTENT -->
	
  </div>
</div>