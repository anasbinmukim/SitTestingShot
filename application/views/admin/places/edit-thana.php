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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Thana</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                      <!-- CHANGE PASSWORD TAB -->
                          <form action="" method="post">
                              <?php
                              $result_thana = $this->common->get( 'place_thana', array( 'ID' => $row_id ) );
                              ?>
                              <div class="form-group">
                                  <label class="control-label">Thana name</label>
                                  <input type="text" name="thana_name" class="form-control" value="<?php echo html_escape($result_thana->thana_name); ?>" /> </div>

              									<div class="form-group">
                										<label class="control-label">Select District</label>
                										<select name="district_id" id="district_id" class="form-control">
                										<?php
                											$district_arr = get_district_arr();
                											foreach($district_arr as $dkey => $dvalue){
                												echo '<option '.selected($result_thana->district_id, $dkey, false).' value="'.$dkey.'">'.$dvalue.'</option>';
                											}
                										?>
                										</select>
              										</div>
                                  <input type="hidden" name="thana_id" value="<?php echo $row_id; ?>">

                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" class="btn green" name="update_thana" value="Update">
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
