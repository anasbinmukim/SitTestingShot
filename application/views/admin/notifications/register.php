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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Notification</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">                               
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Title</label>
                                      <input type="text" class="form-control forcs_background" name="notif_title"/></div>
									  <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea class="form-control forcs_background" name="notif_description"></textarea></div>
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_notification" value="Add Notification">
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