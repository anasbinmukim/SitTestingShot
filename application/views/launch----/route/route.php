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
                    <span class="caption-subject bold uppercase">Launch Route</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/launch/route/register'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">Route</th>
                            <th class="min-phone-l">Place Start/End</th>
                            <th class="min-phone-l">Place Start/End</th>
                            <th class="none">Route Path</th>
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($launch_route_rows as $route) { ?>
                          <tr>
                              <td><?php echo $route->route; ?></td>
                              <td><?php echo $route->place_1; ?></td>
                              <td><?php echo $route->place_2; ?></td>
                              <td><?php echo $route->route_path; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('launch/route/edit/'.encrypt($route->route_id)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this route?\');" href="'.site_url('launch/route/delete/'.encrypt($route->route_id)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
