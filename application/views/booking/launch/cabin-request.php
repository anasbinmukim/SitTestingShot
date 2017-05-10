<!-- BEGIN PAGE HEADER-->
<?php
  $launch_id = $launch_schedule_data['launch_id'];
  $launch_name = $launch_arr[$launch_id]['launch_name'];
  $travel_date = $launch_schedule_data['date'];
  $travel_date = date('l F j, Y', strtotime($travel_date));
  $booking_ref_number = $this->session->userdata('booking_ref_number');
?>
<h1 class="page-title">
  <?php echo $launch_name; ?>
  <span class="label label-success"><?php echo $launch_schedule_data['start_from']; ?> To <?php echo $launch_schedule_data['destination_to'];?></span>
  <span class="label label-info"> <?php echo $travel_date; ?> </span>
</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('/booking/launch'); ?>">Launch</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Cabins</span>
        </li>
    </ul>

</div>
<!-- END PAGE HEADER-->
<?php
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
  <div class="col-md-6">
      <div class="portlet light ">
          <div class="portlet-title">
              <div class="caption font-dark">
                  <i class="icon-settings font-dark"></i>
                  <span class="caption-subject bold uppercase">Selected Cabins</span>
              </div>
          </div>
          <div class="portlet-body">
          <?php
          if(empty($requested_available_cabins)){
            echo "Search and select agian!";
          }else{
          ?>
          <table class="table table-striped table-bordered table-hover">
              <thead>
                  <tr>
                      <th></th>
                      <th> Cabin Number </th>
                      <th style="text-align:right;"> Charge </th>
                      <th style="text-align:right;"> Price </th>
                  </tr>
              </thead>
              <tbody class="total_cabin_items">
                <?php
                  //debug($cabin_booking_cart_items);
                  $total_price = 0;
                  $total_charge = 0;
                  $total_counter = 0;
                ?>
                <?php foreach ($requested_available_cabins as $key => $value) { ?>
                  <tr>
                      <td><?php echo '<div class="center-block"><a onclick="return confirm(\'Are you sure you want to remove this?\');" href="'.site_url('/booking/launchcabin/'.$schedule_solt_id.'/'.$request_cabin_solt_ids.'/'.encrypt($value->ID).'/'.$booking_ref_number).'" title="Remove"><i class="fa fa-times text-danger"></i></a></div>'; ?></td>
                      <td> <?php echo $value->cabin_number; ?> </td>
                      <td style="text-align:right;"> <?php echo seat_taka_format($value->booking_charge); ?> </td>
                      <td style="text-align:right;"> <?php echo seat_taka_format($value->cabin_fare); ?> </td>
                      <?php
                        $total_price += $value->cabin_fare;
                        $total_charge += $value->booking_charge;
                        $total_counter += 1;
                      ?>
                  </tr>
                <?php } ?>

              </tbody>
              <tbody class="total_cabin_price">
                  <tr>
                      <td colspan="2"> Total <span id="total_number_of_selected_cabin" class=""> <?php echo $total_counter; ?> </span> Cabin</td>
                      <td style="text-align:right;"><?php echo seat_taka_format($total_charge); ?></td>
                      <td style="text-align:right;"><?php echo seat_taka_format($total_price); ?></td>
                  </tr>
                  <?php
                    $tax_value = ($total_charge * 5)  / 100 ;
                  ?>
                  <tr>
                      <td colspan="2" style="text-align:right;">Vat/Tax</td>
                      <td colspan="2" style="text-align:right;"><?php echo seat_taka_format($tax_value); ?></td>
                  </tr>
                  <?php
                    $grand_total_value = $tax_value +  $total_charge + $total_price;
                  ?>
                  <tr>
                      <td colspan="2" style="text-align:right;">Grand Total</td>
                      <td colspan="2" style="text-align:right;"><?php echo seat_taka_format($grand_total_value); ?></td>
                  </tr>
              </tbody>
          </table>
          <?php } ?>
          </div>
      </div>
  </div>

    <div class="col-md-6">
      <div class="portlet light ">
          <div class="portlet-title">
              <div class="caption font-dark">
                  <i class="icon-settings font-dark"></i>
                  <span class="caption-subject bold">Passenger Details</span>
              </div>
          </div>
          <div class="portlet-body book_launch_cabin">
              <form action="" method="post">
                <div class="form-group">
                    <label class="control-label">Passenger Name</label>
                    <input type="text" name="passenger_name" class="form-control" value="<?php echo set_value('passenger_name'); ?>" /> </div>
                <div class="form-group">
                    <label class="control-label">Passenger Mobile</label>
                    <input type="text" name="passenger_mobile" class="form-control" value="<?php echo set_value('passenger_mobile'); ?>" /> </div>
                <div class="form-group">
                    <label class="control-label">Passenger Email</label>
                    <input type="text" name="passenger_email" class="form-control" value="<?php echo set_value('passenger_email'); ?>" /> </div>

                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="control-label">Passenger Age</label>
                          <input type="text" name="passenger_age" class="form-control" value="<?php echo set_value('passenger_age'); ?>" /> </div>
                    </div>
                    <div class="col-md-6">
                      <?php
                        $passenger_gender = set_value('passenger_gender');
                      ?>
                      <div class="form-group">
                          <label class="control-label">Passenger Gender</label>
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="passenger_gender" <?php if($passenger_gender == 'Male'){ ?> checked <?php } ?> value="Male" /> Male
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="passenger_gender" <?php if($passenger_gender == 'Female'){ ?> checked <?php } ?> value="Female"/> Female
                                <span></span>
                            </label>
                        </div>
                      </div>
                    </div>
                </div>
                <input type="hidden" name="request_cabin_solt_ids" value="<?php echo $request_cabin_solt_ids; ?>">
                <input type="hidden" name="booking_ref_number" value="<?php echo $booking_ref_number; ?>">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <input type="submit" name="submit_cabins_confirm_request" class="btn green" value="Book Now" />
                &nbsp;&nbsp;&nbsp;
                <input type="submit" name="submit_cabins_cancle_request" class="btn red" value="Cancle Request" />

              </form>
            </div>
        </div>
    </div>
</div><!-- Eof parent row -->
