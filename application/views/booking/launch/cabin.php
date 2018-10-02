<!-- BEGIN PAGE HEADER-->
<?php
  $schedule_id = $launch_schedule_data['sche_id'];
  $launch_id = $launch_schedule_data['launch_id'];
  $launch_name = $launch_arr[$launch_id]['launch_name'];
  $travel_date_db = $launch_schedule_data['date'];
  $travel_date = date('l F j, Y', strtotime($travel_date_db));
?>
<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
?>
<h1 class="page-title">
  <?php echo $launch_name; ?>
  <span class="label label-success"><?php echo $launch_schedule_data['start_from']; ?> To <?php echo $launch_schedule_data['destination_to'];?></span>
  <span class="label label-info"> <?php echo $travel_date; ?> </span>
</h1>

<?php
$double_cabin_seats = array();
//Double cabin pair number is important. Cabin will not display if pair number null or 0
$double_cabin_pair_number = array();

  $cabin_types = array();
  foreach ($available_cabins as $cabins) {
      $cabin_types[] = $cabins->cabin_type;
      if('Double' == $cabins->cabin_type){
        $double_cabin_seats[] = $cabins;
        if($cabins->pair_number != '')
          $double_cabin_pair_number[] = $cabins->pair_number;
      }
  }
  $cabin_types = array_unique($cabin_types);
  if(is_array($double_cabin_pair_number))
    $double_cabin_pair_number = array_unique($double_cabin_pair_number);

?>

<div class="row">
<div class="col-md-8">

  <?php
  //debug($already_proceed_cabins);
  ?>

<div class="row">
<?php foreach ($cabin_types as $cabin_type) { ?>
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Cabin: <?php echo $cabin_type; ?></span>
                </div>
            </div>
            <div class="portlet-body book_launch_cabin">
              <!-- [ID] => 2
              [launch_id] => 1
              [cabin_number] => S234
              [floor] => 4th
              [cabin_class] => B
              [cabin_info] => Hello world, this is VIP cabin
              [cabin_fare] => 3243
              [discount] => 0
              [cabin_type] => VIP
              [allow_person] => 2
              [is_allow] => 1
              [cabin_status] => Available -->
              <?php
              //debug($already_proceed_cabins);
              $cabin_columns = array_column($already_proceed_cabins, 'cabin_id');
              //debug($cabin_columns);
              ?>

              <?php if(($cabin_type == 'Double')){ ?>
                  <div class="row">
                  <?php //debug($double_cabin_pair_number); ?>
                  <?php foreach ($double_cabin_pair_number as $cabin_pair_number) { ?>
                        <?php
                          $both_seat_available = TRUE;
                          $cabin_fare_total = 0;
                          $cabin_ids = array();
                          $cabin_numbers = array();
                          $cabin_fares = array();

                        ?>
                        <div class="double_cabin_box col-md-3">
                        <?php foreach ($double_cabin_seats as $cabins) { ?>
                              <?php if(($cabin_pair_number == $cabins->pair_number)){ ?>
                                <?php
                                  $already_booked_key = '';
                                  $already_booked_key = array_search($cabins->ID, $cabin_columns, true);
                                  $launch_cabin_solt_id = encrypt($cabins->ID);
                                  $cabin_fare_total += $cabins->cabin_fare;

                                  $cabin_ids[] = $launch_cabin_solt_id;
                                  $cabin_fares[] = $cabins->cabin_fare;
                                  $cabin_numbers[] = $cabins->cabin_number;

                                ?>
                                <?php if( is_int($already_booked_key) && ($allow_pair_cabin_booked)){ ?>
                                  <?php $exists_book_status = strtolower($already_proceed_cabins[$already_booked_key]['booking_status']); ?>
                                  <span data-cabin_id = "<?php echo $launch_cabin_solt_id; ?>" data-cabin_number = "<?php echo $cabins->cabin_number; ?>" data-cabin_fare = "<?php echo $cabins->cabin_fare; ?>" class="icon-btn <?php echo 'booking_status_'.$exists_book_status; ?>">
                                      <i class="fa fa-bed"></i>
                                      <div> <?php echo $cabins->cabin_number; ?> </div>
                                      <span class="badge badge-info"> &#x9f3;<?php echo $cabins->cabin_fare; ?> </span>
                                  </span>
                                <?php
                                  $both_seat_available = FALSE;
                                }elseif($allow_pair_cabin_booked){
                                ?>
                                  <a data-cabin_id = "<?php echo $launch_cabin_solt_id; ?>" data-cabin_number = "<?php echo $cabins->cabin_number; ?>" data-cabin_fare = "<?php echo $cabins->cabin_fare; ?>" href="javascript:void(0)" class="icon-btn launch_cabin">
                                      <i class="fa fa-bed"></i>
                                      <div> <?php echo $cabins->cabin_number; ?> </div>
                                      <span class="badge badge-info"> &#x9f3;<?php echo $cabins->cabin_fare; ?> </span>
                                  </a>
                                <?php } ?>
                                <?php $already_booked_key = ''; ?>
                              <?php } ?>
                        <?php } ?>
                        <!-- process double cabin into single button click -->
                        <?php if($both_seat_available && isset($cabin_ids) && (count($cabin_ids) == 2) && (!$allow_pair_cabin_booked)){ ?>
                              <a  data-cabin_type = "double"
                                data-cabin_id_a = "<?php echo $cabin_ids[0]; ?>"
                                data-cabin_id_b = "<?php echo $cabin_ids[1]; ?>"
                                data-cabin_number_a = "<?php echo $cabin_numbers[0]; ?>"
                                data-cabin_number_b = "<?php echo $cabin_numbers[1]; ?>"
                                data-cabin_fare = "<?php echo $cabin_fare_total; ?>"
                                data-cabin_fare_a = "<?php echo $cabin_fares[0]; ?>"
                                data-cabin_fare_b = "<?php echo $cabin_fares[1]; ?>"

                                href="javascript:void(0)" class="icon-btn launch_cabin">
                                  <i class="fa fa-bed"></i>
                                  <i class="fa fa-bed"></i>
                                  <div> <?php echo $cabins->pair_number; ?> </div>
                                  <span class="badge badge-info"> &#x9f3;<?php echo $cabin_fare_total; ?> </span>
                              </a>
                        <?php } ?>

                        </div> <!-- double_cabin_box -->
                  <?php }//EOF foreach pair number ?>
                </div><!--row-->
              <?php }//EOF double cabin process ?>


              <?php foreach ($available_cabins as $cabins) { ?>
                <?php if(($cabin_type == $cabins->cabin_type) && ($cabins->cabin_type != 'Double')){ ?>

                      <?php
                        $already_booked_key = '';
                        $already_booked_key = array_search($cabins->ID, $cabin_columns, true);
                        $launch_cabin_solt_id = encrypt($cabins->ID);
                      ?>

                      <?php if( is_int($already_booked_key) ){ ?>
                        <?php $exists_book_status = strtolower($already_proceed_cabins[$already_booked_key]['booking_status']); ?>
                        <span data-cabin_id = "<?php echo $launch_cabin_solt_id; ?>" data-cabin_number = "<?php echo $cabins->cabin_number; ?>" data-cabin_fare = "<?php echo $cabins->cabin_fare; ?>" class="icon-btn <?php echo 'booking_status_'.$exists_book_status; ?>">
                            <i class="fa fa-bed"></i>
                            <div> <?php echo $cabins->cabin_number; ?> </div>
                            <span class="badge badge-info"> &#x9f3;<?php echo $cabins->cabin_fare; ?> </span>
                        </span>
                      <?php }else{ ?>
                        <a data-cabin_id = "<?php echo $launch_cabin_solt_id; ?>" data-cabin_number = "<?php echo $cabins->cabin_number; ?>" data-cabin_fare = "<?php echo $cabins->cabin_fare; ?>" href="javascript:void(0)" class="icon-btn launch_cabin">
                            <i class="fa fa-bed"></i>
                            <div> <?php echo $cabins->cabin_number; ?> </div>
                            <span class="badge badge-info"> &#x9f3;<?php echo $cabins->cabin_fare; ?> </span>
                        </a>
                      <?php } ?>
                      <?php $already_booked_key = ''; ?>
                  <?php }//EOF Cabin type ?>
              <?php } ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
  <?php } ?>
</div>

</div>
<div class="col-md-4">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject bold uppercase">Selected Cabins</span>
            </div>
        </div>
        <div class="portlet-body">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th> Cabin Number </th>
                    <th> Price </th>
                </tr>
            </thead>
            <tbody class="total_cabin_items">

            </tbody>
            <tbody class="total_cabin_price">
                <tr class="hover">
                    <td> Total <span id="total_number_of_selected_cabin" class=""> 0 </span> Cabin</td>
                    <td> &#x9f3;<span id="total_price">0.00</span></td>
                </tr>
            </tbody>
        </table>
          <form id="form_process_request_cabins" action="" method="post">
            <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
            <input type="hidden" name="launch_id" value="<?php echo $launch_id; ?>">
            <input type="hidden" name="travel_date" value="<?php echo $travel_date_db; ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="submit" id="submit_cabins_request" disabled="disabled" name="submit_cabins_request" class="btn green" value="Request To Book" />
            <input type="button" class="btn default" onClick="window.location.reload()" value="Cancle" />
          </form>

          <?php if($this->session->has_userdata('cart_items_url')){ ?>
              <br /><br /><p><a href="<?php echo site_url($this->session->userdata('cart_items_url')); ?>" class="btn red">Confirm pending cabins</a></p>
          <?php } ?>
        </div>
    </div>
</div>


</div><!-- Eof parent row -->
