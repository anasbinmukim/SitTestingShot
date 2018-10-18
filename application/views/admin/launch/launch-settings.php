<?php
//debug(get_users_by_role());
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
                              <span class="caption-subject font-blue-madison bold uppercase">Settings: <?php echo $launch_data['launch_name']; ?></span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Launch Supervisor</label>
                                      <select name="launch_supervisor" id="launch_supervisor" class="form-control select2me">
                                      <?php
                                        $supervisor_id = $this->common->get_launch_meta($launch_data['ID'], 'launch_supervisor');
                                        $supervisor_arr = get_users_by_role('supervisor');
                                        foreach($supervisor_arr as $sID => $svalue){
                                          echo '<option '.selected($supervisor_id, $sID, false).' value="'.$sID.'">'.$svalue['first_name'].' '.$svalue['last_name'].'-'.$svalue['mobile'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Booking Manager</label>
                                    <select name="launch_booking_manager[]" id="launch_booking_manager" class="form-control select2me"  multiple>
                                      <?php
                                        $supervisor_id = 0;
                                        $supervisor_arr = get_users_by_role('booking_manager');
                                        foreach($supervisor_arr as $sID => $svalue){
                                          echo '<option '.selected($supervisor_id, $sID, false).' value="'.$sID.'">'.$svalue['first_name'].' '.$svalue['last_name'].'-'.$svalue['mobile'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select name="launch_status" id="launch_status" class="form-control select2me">
                                      <option value="">Status</option>
                                      <option <?php selected($launch_data['status'], 0, TRUE); ?> value="0">Inactive</option>
                                      <option <?php selected($launch_data['status'], 1, TRUE); ?> value="1">Active</option>
                                    </select>
                                  </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="margin-top-10">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <input type="hidden" name="settings_launch_id" value="<?php echo $launch_data['ID']; ?>">
                                        <input type="submit" class="btn green" name="update_launch_settings" value="Update">
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
