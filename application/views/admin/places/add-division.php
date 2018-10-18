<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-6">
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Division</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                              <!-- CHANGE PASSWORD TAB -->
                                  <form action="" method="post">
                                      <div class="form-group">
                                          <label class="control-label">Division name</label>
                                          <input type="text" name="division_name" class="form-control" /> </div>
                                      <div class="margin-top-10">
                                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                          <input type="submit" class="btn green" name="add_division" value="Add">
                                      </div>
                                  </form>
                              <!-- END CHANGE PASSWORD TAB -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
