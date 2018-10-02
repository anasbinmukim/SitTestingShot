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
                    <span class="caption-subject bold uppercase">Launch Cabin</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/launch/cabin/register'); ?>">Add New Cabin</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">Cabin Number</th>
                            <th class="min-phone-l">Type</th>
                            <th class="min-phone-l">Launch Name</th>
                            <th class="none">Floor</th>
                            <th class="none">Fare</th>
                            <th class="none">Number of Ticket</th>
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($launch_cabin_rows as $cabin) { ?>
                        <?php
                            $launch_name = '';
                            if(isset($launch_arr[$cabin->launch_id]['launch_name'])){
                                  $launch_name = $launch_arr[$cabin->launch_id]['launch_name'];
                            }
                          ?>
                          <tr>
                              <td><?php echo $cabin->cabin_number; ?></td>
                              <td><?php echo $cabin->cabin_type; ?></td>
                              <td><?php echo $launch_name; ?></td>
                              <td><?php echo $cabin->floor; ?></td>
                              <td><?php echo seat_taka_format($cabin->cabin_fare); ?></td>
                              <td><?php echo $cabin->allow_person; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('launch/cabin/edit/'.encrypt($cabin->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this cabin?\');" href="'.site_url('launch/cabin/delete/'.encrypt($cabin->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
