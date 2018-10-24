<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$request_notification_url = site_url('admin/notifications/get_all/');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Notifications</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/notifications/register'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="notification-tbl" data-url="<?php echo $request_notification_url;?>">
                    <thead>
                        <tr>
                            <th> Date </th>
                            <th> Title </th>
                            <th> Description</th>
                            <th width="50"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
						
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>