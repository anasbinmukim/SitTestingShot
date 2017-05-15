<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Register Schedule</h1>
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
            <span>New Schedule</span>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Schedule</span>
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
                                          foreach($launch_arr as $lkey => $lvalue){
                                            echo '<option value="'.$lvalue['ID'].'">'.$lvalue['launch_name'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Travel Date</label>
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input type="text" class="form-control" readonly="" name="date" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" value="<?php echo set_value('date'); ?>">
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
                                          foreach($launch_route_arr as $rkey => $rvalue){
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
                                        foreach($via_places_arr as $dkey => $dvalue){
                                          echo '<option value="'.$dvalue['place_name'].'">'.$dvalue['place_name'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Leaving Time</label>
                                      <input type="text" name="time_start" class="form-control timepicker timepicker-default" value="<?php echo set_value('time_start'); ?>" /> </div>
                                  <div class="form-group">
                                    <label class="control-label">Destination To</label>
                                      <select name="destination_to" id="destination_to" class="form-control select2me">
                                      <?php
                                        $via_places_arr = get_via_places_arr();
                                        foreach($via_places_arr as $dkey => $dvalue){
                                          echo '<option value="'.$dvalue['place_name'].'">'.$dvalue['place_name'].'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                    <div class="form-group">
                                        <label class="control-label">Arrival Time</label>
                                        <input type="text" name="time_end" class="form-control timepicker timepicker-default" value="<?php echo set_value('time_end'); ?>" /> </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_schedule" value="Add Schedule">
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
