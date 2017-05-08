<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Register Launch Route</h1>
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
            <span>Route</span>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Route</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Route</label>
                                        <input type="text" name="route" placeholder="Dhaka To Barishal" class="form-control" value="<?php echo set_value('route'); ?>" /> </div>
                                    <div class="form-group">
                                      <label class="control-label">Place Start/End</label>
                                        <select name="place_1" id="place_1" class="form-control select2me">
                                        <?php
                                          $district_arr = get_district_arr();
                                          foreach($district_arr as $dkey => $dvalue){
                                            echo '<option value="'.$dvalue.'">'.$dvalue.'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Place Start/End</label>
                                        <select name="place_2" id="place_2" class="form-control select2me">
                                        <?php
                                          $district_arr = get_district_arr();
                                          foreach($district_arr as $dkey => $dvalue){
                                            echo '<option value="'.$dvalue.'">'.$dvalue.'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Route path</label>
                                      <textarea class="form-control" placeholder="dhaka-barishal" name="route_path"><?php echo set_value('route_path'); ?></textarea></div>
                                  <div class="form-group">
                                      <label class="control-label">Route Search</label>
                                      <textarea class="form-control" placeholder="Dhaka, Barishal" name="route_search"><?php echo set_value('route_search'); ?></textarea></div>
                              </div>


                              <div class="col-md-12">
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="submit" class="btn green" name="register_new_route" value="Register Now">
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