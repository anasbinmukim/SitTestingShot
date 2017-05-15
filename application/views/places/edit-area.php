<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Area/Village/Union/Word</h1>
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
            <a href="<?php echo site_url('/places/view/area'); ?>">Area</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Edit Area</span>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Area</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                      <!-- CHANGE PASSWORD TAB -->
                          <form action="" method="post">
                              <?php
                              $result_area = $this->common->get( 'place_area', array( 'ID' => $row_id ) );
                              ?>
                              <div class="form-group">
                                  <label class="control-label">Area name</label>
                                  <input type="text" name="area_name" class="form-control" value="<?php echo html_escape($result_area->area_name); ?>" /> </div>

              									<div class="form-group">
                										<label class="control-label">Select Thana</label>
                										<select name="thana_id" id="thana_id" class="form-control select2me">
                										<?php
                											$thana_arr = get_thana_under_dist_arr();
                											foreach($thana_arr as $tkey => $tvalue){
                                        $selected = 0;
                                        if($tkey == $result_area->thana_id)
                                          $selected = 'selected = "selected" ';

                												echo '<option '.$selected.' value="'.$tkey.'">'.$tvalue.'</option>';
                											}
                										?>
                										</select>
              										</div>
                                  <input type="hidden" name="area_id" value="<?php echo $row_id; ?>">

                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="submit" class="btn green" name="update_area" value="Update">
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
