<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">My Launch Cabin Booking</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">ID</th>
                            <th class="all">Issue Date</th>
                            <th class="all">Travel Date</th>
                            <th class="min-phone-l">Launch Name</th>
                            <th class="min-phone-l">From</th>
                            <th class="min-phone-l">To</th>
                            <th class="min-phone-l">Cabin Numbers</th>
                            <th class="none">Passenger Name</th>
                            <th class="none">Passenger Mobile</th>
                            <th class="none">Boarding Place</th>
                            <th class="none">Dropping Place</th>
                            <th class="none">Route</th>
                            <th class="none">Via Places</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($launch_booking_rows as $booking_row) { ?>
                          <?php
                            $booking_id = sprintf("%08d", $booking_row->ID);
                          ?>
                          <tr>
                              <td><?php echo $booking_id; ?></td>
                              <td><?php echo date('d-m-Y', strtotime($booking_row->booking_date)); ?></td>
                              <td><?php echo date('d-m-Y', strtotime($booking_row->travel_date)); ?></td>
                              <td><?php echo $booking_row->launch_name; ?></td>
                              <td><?php echo $booking_row->start_from; ?></td>
                              <td><?php echo $booking_row->destination_to; ?></td>
                              <td><?php echo $booking_row->total_cabin_numbers; ?></td>
                              <td><?php echo $booking_row->passenger_name; ?></td>
                              <td><?php echo $booking_row->passenger_mobile; ?></td>
                              <td><?php echo $booking_row->boarding; ?></td>
                              <td><?php echo $booking_row->dropping; ?></td>
                              <td><?php echo $booking_row->route_name; ?></td>
                              <td><?php echo $booking_row->via_places; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
