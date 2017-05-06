<!-- BEGIN PAGE HEADER-->
<!-- <h1 class="page-title">Launch Booking</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Cabin booking</span>
        </li>
    </ul>
</div> -->
<!-- END PAGE HEADER-->
<?php
require_once(FCPATH.'/application/views/success-error-message.php');
$search_date = date('Y-m-d');
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Search available launch</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/booking/launch'); ?>">Reload</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <form action="" method="post">
                    <div class="row">
                      <div class="col-md-4">
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
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                              <label class="control-label">Travel Date</label>
                              <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                  <input type="text" class="form-control" readonly="" name="travel_date" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" value="<?php echo $search_date; ?>">
                                  <span class="input-group-btn">
                                      <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                      </button>
                                  </span>
                              </div><span id="datepicker-error" class="help-block help-block-error"></span>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Leaving From</label>
                              <select name="start_from" id="start_from" class="form-control select2me">
                              <?php
                                $via_places_arr = get_via_places_arr();
                                foreach($via_places_arr as $dkey => $dvalue){
                                  echo '<option value="'.$dvalue['place_name'].'">'.$dvalue['detail'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                            <label class="control-label">Destination To</label>
                              <select name="destination_to" id="destination_to" class="form-control select2me">
                              <?php
                                $via_places_arr = get_via_places_arr();
                                foreach($via_places_arr as $dkey => $dvalue){
                                  echo '<option value="'.$dvalue['place_name'].'">'.$dvalue['detail'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                          <label class="control-label" style="visibility: hidden;">Search Now</label>
                          <input type="submit" class="btn green" name="launch_booking_search" value="Search Now">
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
