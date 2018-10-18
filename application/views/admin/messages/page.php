<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$request_user_url = site_url('admin/test/get_all/');

?>
<div class="row">
    <div class="col-md-12">
        <!-- Begin: User List Table -->
        <div class="portlet light portlet-fit portlet-datatable ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-user font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Manage Users</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/admin/users/register'); ?>">Add New User</a>
                    </div>
                </div>               
            </div>

            <div class="portlet-body">
                <div class="table-container">                    
                    <table class="table table-striped table-bordered table-hover table-checkable" id="users-tbl" data-url="<?php echo $request_user_url;?>">
                        <thead>
                            <tr>

                                <th> ID </th>
                                <th> Date </th>
                                <th> Subject </th>
                                <th> Message </th>
                            </tr>
                            
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: Users List Table -->
    </div>
</div>
