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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit District</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                      <!-- CHANGE PASSWORD TAB -->
                          <form action="" method="post">
                              <?php
                              $result_district = $this->common->get( 'place_district', array( 'ID' => $row_id ) );
                              ?>
                              <div class="form-group">
                                  <label class="control-label">District name</label>
                                  <input type="text" name="district_name" class="form-control" value="<?php echo html_escape($result_district->district_name); ?>" /> </div>

              									<div class="form-group">
                										<label class="control-label">Select Division</label>
                										<select name="division_id" id="division_id" class="form-control">
                										<?php
                											$division_arr = get_divisions_arr();
                											foreach($division_arr as $dkey => $dvalue){
                                        $selected = 0;
                                        if($dkey == $result_district->division_id)
                                          $selected = 'selected = "selected" ';

                												echo '<option '.$selected.' value="'.$dkey.'">'.$dvalue.'</option>';
                											}
                										?>
                										</select>
              										</div>
                                  <input type="hidden" name="district_id" value="<?php echo $row_id; ?>">

                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" class="btn green" name="update_district" value="Update">
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
