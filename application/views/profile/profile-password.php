<div class="row">
    <div class="col-md-12">
      <?php require_once(dirname(__FILE__) . "/profile-view-widget.php"); ?>
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                          </div>
                          <?php require_once(dirname(__FILE__) . "/profile-tab-nav.php"); ?>
                      </div>
                      <div class="portlet-body">
                          <div class="tab-content">
                              <!-- CHANGE PASSWORD TAB -->
                              <div class="tab-pane active" id="tab_1_3">
                                  <form action="" method="post">
                                      <div class="form-group">
                                          <label class="control-label">Current Password</label>
                                          <input type="password" name="current_pass" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">New Password</label>
                                          <input type="password" name="password" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Re-type New Password</label>
                                          <input type="password" name="conf_password" class="form-control" /> </div>
                                      <div class="margin-top-10">
                                          <input type="submit" class="btn green" name="update_password" value="Change Password">
                                      </div>
                                  </form>
                              </div>
                              <!-- END CHANGE PASSWORD TAB -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
