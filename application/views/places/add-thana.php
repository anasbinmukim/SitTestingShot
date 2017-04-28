<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Thana/Upzilla of Bangladesh</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('places'); ?>">Places</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>District</span>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Thana/Upzilla</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                              <!-- CHANGE PASSWORD TAB -->
                                  <form action="" method="post">
                                      <div class="form-group">
                                          <label class="control-label">Thana/Upzilla name</label>
                                          <input type="text" name="division_name" class="form-control" /> </div>
										  
										<div class="form-group">
										<label class="control-label">Select District</label>
										<select name="" id="" class="form-control">  
										<?php 
											$district_arr = get_district_arr();
											print_r($district_arr);
											foreach($district_arr as $dkey => $dvalue){
												echo '<option value="'.$dkey.'">'.$dvalue.'</option>';
											}
										?>  
										</select>
										</div>
										
										  
                                      <div class="margin-top-10">
                                          <input type="submit" class="btn green" name="add_division" value="Add">
                                      </div>
                                  </form>
                              <!-- END CHANGE PASSWORD TAB -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
