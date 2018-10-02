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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Counter</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Select Company</label>
                                      <select name="company_id" id="company_id" class="form-control select2me">
                                      <?php
                                        $companies_arr = get_companies_arr();
                                        foreach($companies_arr as $ckey => $cvalue){
                                          echo '<option value="'.$ckey.'">'.$cvalue.'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                    <div class="form-group">
                                        <label class="control-label">Counter name</label>
                                        <input type="text" name="counter_name" class="form-control" value="<?php echo set_value('counter_name'); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Incharge Name</label>
                                        <input type="text" name="incharge_name" class="form-control" value="<?php echo set_value('incharge_name'); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Incharge mobile</label>
                                        <input type="text" name="incharge_mobile" class="form-control" value="<?php echo set_value('incharge_mobile'); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Incharge Email</label>
                                        <input type="text" name="incharge_email" class="form-control" value="<?php echo set_value('incharge_email'); ?>" /> </div>

                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Contact Info</label>
                                      <textarea class="form-control" name="contact_info"><?php echo set_value('contact_info'); ?></textarea></div>
                                  <div class="form-group">
                                      <label class="control-label">Address</label>
                                      <textarea class="form-control" name="address"><?php echo set_value('address'); ?></textarea></div>

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
                                  <div class="form-group">
                                    <label class="control-label">Select District</label>
                                      <select name="district_id" id="district_id" class="form-control select2me">
                                      <?php
                                      	$district_arr = get_district_arr();
                                      	foreach($district_arr as $dkey => $dvalue){
                                      		echo '<option value="'.$dkey.'">'.$dvalue.'</option>';
                                      	}
                                      ?>
                                    </select>
                                  </div>
                              </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_counter" value="Register Now">
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
