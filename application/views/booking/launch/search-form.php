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
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/LaunchBooking'); ?>">Reload</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <form action="" method="post">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <select name="launch_id" id="launch_id" class="form-control select2me">
                                  <option value="id">Select Launch</option>
                              <?php
                                if(isset($launch_search_arr['launch'])){
                                  $launch_arr = $launch_search_arr['launch'];
                                  foreach($launch_arr as $lkey => $lvalue){
                                    $selected = '';
                                    if($lvalue['ID'] == $search_launch_id)
                                      $selected = 'selected = "selected" ';
                                    echo '<option '.$selected.' value="'.$lvalue['ID'].'">'.$lvalue['launch_name'].'</option>';
                                  }
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                              <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                  <input type="text" class="form-control" readonly="" name="travel_date" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error" value="<?php echo $search_travel_date; ?>">
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
                              <select name="start_from" id="start_from" class="form-control select2me">
                                  <option value="from">Select From</option>
                                    <?php
                                      if(isset($launch_search_arr['places'])){
                                        $via_places_arr = $launch_search_arr['places'];
                                        foreach($via_places_arr as $place){
                                          $selected = '';
                                          if($place == $search_start_from)
                                            $selected = 'selected = "selected" ';
                                          echo '<option '.$selected.' value="'.$place.'">'.$place.'</option>';
                                        }
                                      }
                                    ?>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                             <select name="destination_to" id="destination_to" class="form-control select2me">
                                <option value="to">Select To</option>
                                <?php
                                  if(isset($launch_search_arr['places'])){
                                    $via_places_arr = $launch_search_arr['places'];
                                    foreach($via_places_arr as $place){
                                      $selected = '';
                                      if($place == $search_destination_to)
                                        $selected = 'selected = "selected" ';
                                      echo '<option '.$selected.' value="'.$place.'">'.$place.'</option>';
                                    }
                                  }
                                ?>
                            </select>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                          <input type="submit" class="btn green" name="launch_booking_search" value="Search Now">
                      </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
