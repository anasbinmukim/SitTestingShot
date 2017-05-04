<?php $launch_data = $this->common->get( 'launch', array( 'ID' => $launch_id ) ); ?>
<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Edit Launch</h1>
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
            <span>Edit Launch</span>
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
                                            $selected = 0;
                                            if($ckey == $company_id)
                                              $selected = 'selected = "selected" ';
                                            echo '<option '.$selected.' value="'.$ckey.'">'.$cvalue.'</option>';
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
                                            $selected = 0;
                                            if($rkey == $route_id)
                                              $selected = 'selected = "selected" ';
                                            echo '<option '.$selected.' value="'.$rkey.'">'.$rvalue['route_path'].'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Place One Leaving Time</label>
                                        <input type="text" name="time_start_place_1" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_start_place_1); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Place One Arrival Time</label>
                                        <input type="text" name="time_end_place_1" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_end_place_1); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Place Two Leaving Time</label>
                                        <input type="text" name="time_start_place_2" class="form-control timepicker timepicker-default" value="<?php echo html_escape($launch_data->time_start_place_2); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Place Two Arrival Time</label>
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
