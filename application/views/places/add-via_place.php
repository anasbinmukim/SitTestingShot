<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">New Via Place</h1>
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
            <span>Via place</span>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Add New Place</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                              <div class="form-group">
                                  <label class="control-label">Place name</label>
                                  <input type="text" name="place_name" class="form-control" /> </div>
                              <div class="form-group">
                                  <label class="control-label">Place address</label>
                                  <input type="text" name="address" class="form-control" /> </div>
          										<div class="form-group">
              										<label class="control-label">Select Thana/Upazilla</label>
              										<select name="thana_id" id="thana_id" class="form-control select2me">
              										<?php
              											$thana_arr = get_thana_arr();
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
                              <div class="form-group">
                                  <label class="control-label">Type</label>
                                  <select name="type" id="type" class="form-control select2me">
                                  <?php
                                    $via_place_arr = get_via_place_type_arr();
                                    foreach($via_place_arr as $pkey => $pvalue){
                                      echo '<option value="'.$pkey.'">'.$pvalue.'</option>';
                                    }
                                  ?>
                                  </select>
                              </div>
                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" class="btn green" name="add_via_place" value="Add">
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
