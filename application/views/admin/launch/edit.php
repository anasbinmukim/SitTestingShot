<?php
  $launch_data = $this->common->get( 'launch', array( 'ID' => $launch_id ) );

  $join_arr_left = array(
    'via_place vp_1' => 'vp_1.ID = lr.place_1',
    'via_place vp_2' => 'vp_2.ID = lr.place_2',
  );
  $route_data = $this->common->get( 'launch_route lr', array( 'route_id' => $launch_data->route_id ), 'array', 'lr.*, vp_1.place_name as place_1, vp_2.place_name as place_2', $join_arr_left );
  //debug($route_data);
?>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Update Launch</span>
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
                                          $company_id = $launch_data->company_id;
                                          foreach($companies_arr as $ckey => $cvalue){
                                            echo '<option '.selected($company_id, $ckey, false).' value="'.$ckey.'">'.$cvalue.'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lanch Name</label>
                                        <input type="text" name="launch_name" placeholder="M.V. Sonar Tori" class="form-control" value="<?php echo html_escape($launch_data->launch_name); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Total Cabin</label>
                                        <input type="text" name="total_cabin" placeholder="120" class="form-control" value="<?php echo html_escape($launch_data->total_cabin); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Total Capacity</label>
                                        <input type="text" name="total_capacity" placeholder="800" class="form-control" value="<?php echo html_escape($launch_data->total_capacity); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Register Info</label>
                                        <textarea class="form-control" name="register_info"><?php echo html_escape($launch_data->register_info); ?></textarea></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Route</label>
                                        <select name="route_id" id="route_id" class="form-control select2me">
                                        <?php
                                          $route_id = $launch_data->route_id;
                                          foreach($launch_route_arr as $rkey => $rvalue){
                                            echo '<option '.selected($route_id, $rkey, false).' value="'.$rkey.'">'.$rvalue['route_path'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Leaving Time: <?php echo $route_data['place_1']; ?></label>
                                        <input type="text" name="time_start_place_1" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_start_place_1); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Arrival Time: <?php echo $route_data['place_1']; ?></label>
                                        <input type="text" name="time_end_place_1" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_end_place_1); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Leaving Time: <?php echo $route_data['place_2']; ?></label>
                                        <input type="text" name="time_start_place_2" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_start_place_2); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Arrival Time: <?php echo $route_data['place_2']; ?></label>
                                        <input type="text" name="time_end_place_2" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_end_place_2); ?>" /> </div>
                                  </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="hidden" name="update_launch_id" value="<?php echo $launch_data->ID; ?>">
                                      <input type="submit" class="btn green" name="update_launch" value="Update">
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
                              <span class="caption-subject font-blue-madison bold uppercase">Dropping time: <?php echo $route_data['place_1']; ?> To <?php echo $route_data['place_2']; ?></span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <?php
                              $update_p1_to_p2_data = '';
                              $update_p1_to_p2_data = $launch_data->dropping_p1_to_p2;
                              if($update_p1_to_p2_data != ''){
                                $update_p1_to_p2_data_arr = json_decode($update_p1_to_p2_data, TRUE);
                              }

                              $route_p1_to_p2_arr = '';
                              $route_p1_to_p2_comma_str = '';
                              if(isset($route_data['route_path'])){
                                  $route_data_arr = explode(',', $route_data['route_search']);
                                      foreach ($route_data_arr as $route_name) {
                                        $route_name  = trim($route_name);
                                        $route_p1_to_p2_arr[]  = $route_name;
                                        $existing_time = $launch_data->time_end_place_2;
                                        if(isset($update_p1_to_p2_data_arr[$route_name])){
                                            $existing_time = $update_p1_to_p2_data_arr[$route_name];
                                        }
                                      ?>
                                      <div class="form-group">
                                          <label class="control-label"><?php echo $route_data['place_1']; ?> To <?php echo $route_name; ?></label>
                                          <input type="text" name="place_1_drop[]" class="form-control timepicker timepicker-default" value="<?php echo html_escape($existing_time); ?>" /> </div>

                                <?php } ?>
                                <?php
                                  $route_p1_to_p2_comma_str = implode(',', $route_p1_to_p2_arr);
                                ?>
                            <?php } ?>
                            <div class="margin-top-10">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="update_launch_id" value="<?php echo $launch_data->ID; ?>">
                                <input type="hidden" name="p1_to_p2" value="<?php echo $route_p1_to_p2_comma_str; ?>">
                                <input type="submit" class="btn green" name="update_droping_time_p1_to_p2" value="Update Time">
                            </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->
  </div>
  <div class="col-md-6">
    <!-- BEGIN PROFILE CONTENT -->
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Dropping time: <?php echo $route_data['place_2']; ?> To <?php echo $route_data['place_1']; ?></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                      <form action="" method="post">
                        <?php
                          $update_p2_to_p1_data = '';
                          $update_p2_to_p1_data = $launch_data->dropping_p2_to_p1;
                          if($update_p2_to_p1_data != ''){
                            $update_p2_to_p1_data_arr = json_decode($update_p2_to_p1_data, TRUE);
                          }

                          $route_p2_to_p1_arr = '';
                          $route_p2_to_p1_comma_str = '';
                          if(isset($route_data['route_path'])){
                              $route_data_arr2 = explode(',', $route_data['route_search']);
                                  foreach ($route_data_arr2 as $route_name) {
                                    $route_name  = trim($route_name);
                                    $route_p2_to_p1_arr[]  = $route_name;
                                    $existing_time = $launch_data->time_end_place_1;
                                    if(isset($update_p2_to_p1_data_arr[$route_name])){
                                        $existing_time = $update_p2_to_p1_data_arr[$route_name];
                                    }
                                  ?>
                                  <div class="form-group">
                                      <label class="control-label"><?php echo $route_data['place_2']; ?> To <?php echo $route_name; ?></label>
                                      <input type="text" name="place_2_drop[]" class="form-control timepicker timepicker-default" value="<?php echo html_escape($existing_time); ?>" /> </div>

                            <?php } ?>
                            <?php
                              $route_p2_to_p1_comma_str = implode(',', $route_p2_to_p1_arr);
                            ?>
                        <?php } ?>
                        <div class="margin-top-10">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="update_launch_id" value="<?php echo $launch_data->ID; ?>">
                            <input type="hidden" name="p2_to_p1" value="<?php echo $route_p2_to_p1_comma_str; ?>">
                            <input type="submit" class="btn green" name="update_droping_time_p2_to_p1" value="Update Time">
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
