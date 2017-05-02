<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Register New Launch</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Add New</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<?php
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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Launch</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                              <div class="form-group">
                                  <label class="control-label">Lanuch name</label>
                                  <input type="text" name="launch_name" class="form-control" /> </div>



                										<div class="form-group">
                    										<label class="control-label">Select Division</label>
                    										<select name="division_id" id="division_id" class="form-control">
                    										<?php
                    											$division_arr = get_divisions_arr();
                    											foreach($division_arr as $dkey => $dvalue){
                    												echo '<option value="'.$dkey.'">'.$dvalue.'</option>';
                    											}
                    										?>
                    										</select>
                										</div>


                              <div class="margin-top-10">
                                  <input type="submit" class="btn green" name="register_new_launch" value="Register Now">
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
