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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Message</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
									<div class="form-group">
                                      <label class="control-label">Message To</label>
                                        <select name="message_to" id="message_to" class="form-control select2me">
                                        <?php
                                          foreach($user_info as $rvalue){
                                            echo '<option value="'.$rvalue->ID.'">'.$rvalue->display_name.'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Message Subject</label>
                                        <input type="text" name="msg_subject" class="form-control" value="<?php echo set_value('company_name'); ?>" /> </div>                                                                     
                              </div>                              
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Message Content</label>
                                      <textarea class="form-control ckeditor" name="msg_content"><?php echo set_value('company_description'); ?></textarea></div>
									  <div class="form-group">
                                        <label class="control-label">Message Excerpt</label>
                                        <textarea class="form-control" name="msg_excerpt"> <?php echo set_value('company_address'); ?> </textarea></div>
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_message" value="Register Now">
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
