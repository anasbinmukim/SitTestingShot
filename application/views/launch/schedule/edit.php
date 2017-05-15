<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Edit Schedule</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('launch'); ?>">Launch</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Edit Schedule</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<?php
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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Schedule</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
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
                                            echo '<option value="'.$rkey.'">'.$rvalue['route_path'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                          echo '<option value="'.$dvalue['place_name'].'">'.$dvalue['place_name'].'</option>';
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
                                          echo '<option value="'.$dvalue['place_name'].'">'.$dvalue['place_name'].'</option>';
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
</div>
