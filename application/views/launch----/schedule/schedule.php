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
                    <span class="caption-subject bold uppercase">Launch Schedule</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/launch/schedule/register'); ?>">Add New Schedule</a>
                    </div>
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
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($launch_schedule_rows as $schedule) { ?>
                          <tr>
                              <td><?php echo $schedule->launch_name; ?></td>
                              <td><?php echo $schedule->date; ?></td>
                              <td><?php echo $schedule->start_from; ?></td>
                              <td><?php echo $schedule->destination_to; ?></td>
                              <td><?php echo $schedule->route_path; ?></td>
                              <td><?php echo $schedule->start_time; ?></td>
                              <td><?php echo $schedule->destination_time; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('launch/schedule/edit/'.encrypt($schedule->sche_id)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this schedule?\');" href="'.site_url('launch/schedule/delete/'.encrypt($schedule->sche_id)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
