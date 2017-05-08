<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Available Launch</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">Launch Name</th>
                            <th class="min-phone-l">Date</th>
                            <th class="min-phone-l">From</th>
                            <th class="min-phone-l">To</th>
                            <th class="none">Route</th>
                            <th class="none">Start Time</th>
                            <th class="none">Destination Time</th>
                            <th width="20" class="all">Available</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($launch_schedule_rows as $schedule) { ?>
                        <?php
                            $launch_id = $schedule->launch_id;
                            $launch_name = '';
                            if(isset($launch_arr[$schedule->launch_id]['launch_name'])){
                                  $launch_name = $launch_arr[$schedule->launch_id]['launch_name'];
                            }

                            $available_cabins = 0;
                          ?>
                          <tr>
                              <td><?php echo $launch_name; ?></td>
                              <td><?php echo $schedule->date; ?></td>
                              <td><?php echo $schedule->start_from; ?></td>
                              <td><?php echo $schedule->destination_to; ?></td>
                              <td><?php echo $schedule->route_name; ?></td>
                              <td><?php echo $schedule->start_time; ?></td>
                              <td><?php echo $schedule->destination_time; ?></td>
                              <td><?php echo '<div class="center-block"><a class="btn green btn-outline btn-circle btn-sm" href="'.site_url('/booking/launch-cabin/'.encrypt($schedule->sche_id)).'" title="Available Cabins">Cabins ('.$available_cabins.') </a>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
