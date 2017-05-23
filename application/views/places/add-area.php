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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Area</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                              <div class="form-group">
                                  <label class="control-label">Area name</label>
                                  <input type="text" name="area_name" class="form-control" /> </div>
          										<div class="form-group">
          										  <label class="control-label">Select Thana</label>
            										<select name="thana_id" id="thana_id" class="form-control select2me">
            										<?php
            											$thana_arr = get_thana_under_dist_arr();
            											foreach($thana_arr as $tkey => $tvalue){
            												echo '<option value="'.$tkey.'">'.$tvalue.'</option>';
            											}
            										?>
            										</select>
            										</div>
                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" class="btn green" name="add_area" value="Add">
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
