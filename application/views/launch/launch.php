<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Launch</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Launch</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<?php
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Launch</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/launch/register'); ?>">Add New Lanuch</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">Name</th>
                            <th class="min-phone-l">Route</th>
                            <th class="none">Place 1</th>
                            <th class="none">Place 2</th>
                            <th class="none">Via places</th>
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($launch_rows as $launch) { ?>
                          <tr>
                              <td><?php echo $launch->launch_name; ?></td>
                              <td><?php echo $launch->route; ?></td>
                              <td><?php echo $launch->place_1; ?></td>
                              <td><?php echo $launch->place_2; ?></td>
                              <td><?php echo $launch->route_path; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('launch/edit/'.encrypt($launch->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this launch?\');" href="'.site_url('launch/delete/'.encrypt($launch->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
