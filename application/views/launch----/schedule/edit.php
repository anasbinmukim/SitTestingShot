<?php
$join_arr_left = array(
  'via_place vp_1' => 'vp_1.ID = lr.place_1',
  'via_place vp_2' => 'vp_2.ID = lr.place_2',
);
$route_data = $this->common->get( 'launch_route lr', array( 'route_id' => $schedule_data['route_id'] ), 'array', 'lr.*, vp_1.place_name as place_1, vp_2.place_name as place_2', $join_arr_left );
?>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Schedule</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Select Launch</label>
                                        <select name="launch_id" id="launch_id" class="form-control select2me">
                                        <?php
                                          $launch_id = $schedule_data['launch_id'];
                                          foreach($launch_arr as $lkey => $lvalue){
                                            $selected = 0;
                                            if($launch_id == $lvalue['ID'])
                                              $selected = 'selected = "selected" ';
                                            echo '<option '.$selected.' value="'.$lvalue['ID'].'">'.$lvalue['launch_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Travel Date</label>
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control" readonly="" name="date" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" value="<?php echo html_escape($schedule_data['date']); ?>">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div><span id="datepicker-error" class="help-block help-block-error"></span>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Route</label>
                                        <select name="route_id" id="route_id" class="form-control select2me">
                                        <?php
                                          $route_id = $schedule_data['route_id'];
                                          foreach($launch_route_arr as $rkey => $rvalue){
                                            $selected = 0;
                                            if($route_id == $rkey)
                                              $selected = 'selected = "selected" ';
                                            echo '<option '.$selected.' value="'.$rkey.'">'.$rvalue['route_path'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label">Start From</label>
                                      <select name="start_from" id="start_from" class="form-control select2me">
                                      <?php
                                        $via_places_arr = get_via_places_arr();
                                        $start_from = $schedule_data['start_from'];
                                        foreach($via_places_arr as $dkey => $dvalue){
                                          $selected = 0;
                                          if($start_from == $dvalue['place_name'])
                                            $selected = 'selected = "selected" ';
                                          echo '<option '.$selected.' value="'.$dvalue['place_name'].'">'.$dvalue['place_name'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Leaving Time</label>
                                      <input type="text" name="time_start" class="form-control timepicker timepicker-default" value="<?php echo html_escape($schedule_data['start_time']); ?>" /> </div>
                                  <div class="form-group">
                                    <label class="control-label">Destination To</label>
                                      <select name="destination_to" id="destination_to" class="form-control select2me">
                                      <?php
                                        $via_places_arr = get_via_places_arr();
                                        $destination_to = $schedule_data['destination_to'];
                                        foreach($via_places_arr as $dkey => $dvalue){
                                          $selected = 0;
                                          if($destination_to == $dvalue['place_name'])
                                            $selected = 'selected = "selected" ';
                                          echo '<option '.$selected.' value="'.$dvalue['place_name'].'">'.$dvalue['place_name'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                    <div class="form-group">
                                        <label class="control-label">Arrival Time</label>
                                        <input type="text" name="time_end" class="form-control timepicker timepicker-default" value="<?php echo html_escape($schedule_data['destination_time']); ?>" /> </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="hidden" name="update_schedule_id" value="<?php echo $schedule_data['sche_id']; ?>">
                                      <input type="submit" class="btn green" name="update_schedule" value="Update Schedule">
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


<?php
//get if p1_to_p2 OR p2_to_p1
$flag_p1_to_p2 = TRUE;
$start_from = $schedule_data['start_from'];
$place_1 = $route_data['place_1'];
if($start_from !== $place_1){
  $flag_p1_to_p2 = FALSE;
}

?>
    <div class="col-md-6">
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Dropping time: <?php echo $schedule_data['start_from']; ?> To <?php echo $schedule_data['destination_to']; ?></span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <?php
                              //get data from schedule table
                              $update_p1_to_p2_data = '';
                              $update_p1_to_p2_data = $schedule_data['dropping_place_time'];
                              if($update_p1_to_p2_data != ''){
                                $update_p1_to_p2_data_arr = json_decode($update_p1_to_p2_data, TRUE);
                              }

                              //get launch default route path dropping time
                              if($flag_p1_to_p2){
                                $get_launch_default_dropping_time = $schedule_launch_data['dropping_p1_to_p2'];
                              }else{
                                $get_launch_default_dropping_time = $schedule_launch_data['dropping_p2_to_p1'];
                              }
                              if($get_launch_default_dropping_time != ''){
                                $launch_default_dropping_data_arr = json_decode($get_launch_default_dropping_time, TRUE);
                              }

                              $route_p1_to_p2_arr = '';
                              $route_p1_to_p2_comma_str = '';
                              if(isset($route_data['route_path'])){
                                  $route_data_arr = explode(',', $route_data['route_search']);
                                      foreach ($route_data_arr as $route_name) {
                                        $route_name  = trim($route_name);
                                        $route_p1_to_p2_arr[]  = $route_name;
                                        $existing_time = '';
                                        if(isset($launch_default_dropping_data_arr[$route_name])){
                                            $existing_time = $launch_default_dropping_data_arr[$route_name];
                                        }
                                        if(isset($update_p1_to_p2_data_arr[$route_name])){
                                            $existing_time = $update_p1_to_p2_data_arr[$route_name];
                                        }
                                      ?>
                                      <div class="form-group">
                                          <label class="control-label"><?php echo $schedule_data['start_from']; ?> To <?php echo $route_name; ?></label>
                                          <input type="text" name="place_time_to_drop[]" class="form-control timepicker timepicker-default" value="<?php echo html_escape($existing_time); ?>" /> </div>

                                <?php } ?>
                                <?php
                                  $route_p1_to_p2_comma_str = implode(',', $route_p1_to_p2_arr);
                                ?>
                            <?php } ?>
                            <div class="margin-top-10">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="update_schedule_id" value="<?php echo $schedule_data['sche_id']; ?>">
                                <input type="hidden" name="route_places_to_drop" value="<?php echo $route_p1_to_p2_comma_str; ?>">
                                <input type="submit" class="btn green" name="update_droping_place_time" value="Update Time">
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
