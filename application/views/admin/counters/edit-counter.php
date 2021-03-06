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
                              <span class="caption-subject font-blue-madison bold uppercase">Update Company Counter</span>
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
                                        $company_id = $counter_data['company_id'];
                                        foreach($companies_arr as $ckey => $cvalue){
                                          $selected = 0;
                                          if($ckey == $company_id)
                                            $selected = 'selected = "selected" ';
                                          echo '<option '.$selected.' value="'.$ckey.'">'.$cvalue.'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                    <div class="form-group">
                                        <label class="control-label">Counter name</label>
                                        <input type="text" name="counter_name" class="form-control" value="<?php echo html_escape($counter_data['counter_name']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Incharge Name</label>
                                        <input type="text" name="incharge_name" class="form-control" value="<?php echo html_escape($counter_data['incharge_name']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Incharge mobile</label>
                                        <input type="text" name="incharge_mobile" class="form-control" value="<?php echo html_escape($counter_data['incharge_mobile']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Incharge Email</label>
                                        <input type="text" name="incharge_email" class="form-control" value="<?php echo html_escape($counter_data['incharge_email']); ?>" /> </div>

                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Contact Info</label>
                                      <textarea class="form-control" name="contact_info"><?php echo html_escape($counter_data['contact_info']); ?></textarea></div>
                                  <div class="form-group">
                                      <label class="control-label">Address</label>
                                      <textarea class="form-control" name="address"><?php echo html_escape($counter_data['address']); ?></textarea></div>

                                  <div class="form-group">
                                    <label class="control-label">Select Thana</label>
                                      <select name="thana_id" id="thana_id" class="form-control select2me">
                                      <?php
                                      	$thana_arr = get_thana_under_dist_arr();
                                        $thana_id = $counter_data['thana_id'];
                                      	foreach($thana_arr as $tkey => $tvalue){
                                          $selected = 0;
                                          if($tkey == $thana_id)
                                            $selected = 'selected = "selected" ';
                                          echo '<option '.$selected.' value="'.$tkey.'">'.$tvalue.'</option>';
                                      	}
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">Select District</label>
                                      <select name="district_id" id="district_id" class="form-control select2me">
                                      <?php
                                        $district_id = $counter_data['district_id'];
                                      	$district_arr = get_district_arr();
                                      	foreach($district_arr as $dkey => $dvalue){
                                          $selected = 0;
                                          if($dkey == $district_id)
                                            $selected = 'selected = "selected" ';
                                          echo '<option '.$selected.' value="'.$dkey.'">'.$dvalue.'</option>';
                                      	}
                                      ?>
                                    </select>
                                  </div>
                              </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="hidden" name="update_counter_id" value="<?php echo $counter_data['ID']; ?>">
                                      <input type="submit" class="btn green" name="update_counter" value="Update Now">
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
