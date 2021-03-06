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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Place</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                              <div class="form-group">
                                  <label class="control-label">Place name</label>
                                  <input type="text" name="place_name" class="form-control" value="<?php echo set_value('place_name'); ?>" /> </div>
                              <div class="form-group">
                                  <label class="control-label">Place address</label>
                                  <input type="text" name="address" class="form-control" value="<?php echo set_value('address'); ?>" /> </div>
          										<div class="form-group">
              										<label class="control-label">Select Thana/Upazilla</label>
              										<select name="thana_id" id="thana_id" class="form-control select2me">
              										<?php
              											$thana_arr = get_thana_under_dist_arr();
              											foreach($thana_arr as $tkey => $tvalue){
              												echo '<option value="'.$tkey.'">'.$tvalue.'</option>';
              											}
              										?>
              										</select>
          										</div>
                              <div class="form-group">
                                  <label class="control-label">Type</label>
                                  <select name="type" id="type" class="form-control select2me">
                                  <?php
                                    $via_place_arr = get_via_place_type_arr();
                                    foreach($via_place_arr as $pkey => $pvalue){
                                      echo '<option value="'.$pkey.'">'.$pvalue.'</option>';
                                    }
                                  ?>
                                  </select>
                              </div>
                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" class="btn green" name="add_via_place" value="Add">
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
