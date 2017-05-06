<!-- BEGIN PAGE HEADER-->
<h1 class="page-title"> Users</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url();?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Users</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<?php
require_once(FCPATH.'/application/views/success-error-message.php');
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
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Deleted</option>
                        </select>
                        <button class="btn btn-sm green table-group-action-submit">
                            <i class="fa fa-check"></i> Submit</button>
                    </div>

                    <table class="table table-striped table-bordered table-hover table-checkable" id="users-tbl" data-url="<?php echo site_url('admin/users/get_all');?>">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Role </th>
                                <th> Status </th>
                                <th class="text-center"> Created </th>
                                <th class="text-center"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td class="filter-cw-td"></td>
                                <td class="filter-cw-td"><input type="text" name="name" placeholder="Name" id="name" class="form-control form-filter input-sm" value=""></td>
                                <td class="filter-cw-td"><input type="text" name="email" class="form-control form-filter input-sm"></td>
                                <td class="filter-cw-td">
                                    <select class="form-control form-filter input-sm" name="user_role">
                                        <option value="">Select</option>
                                        <option value="administrator">Administrator</option>
                                        <option value="agent">Agent</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="company_owner">Company Owner</option>
                                        <option value="company_manager">Company Manager</option>
                                        <option value="subscriber">Subscriber</option>
                                    </select>
                                </td>
                                <td class="filter-cw-td">
                                    <select class="form-control form-filter input-sm" name="is_active">
                                        <option value="">Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Deleted</option>
                                    </select>
                                </td>
                                <td class="filter-cw-td"><input type="text" name="created_at" class="form-control form-filter input-sm date-picker_created"></td>

                                <td class="filter-cw-td">

                                    <button class="btn btn-xs green btn-outline filter-submit margin-bottom">
                                        <i class="fa fa-search"></i>
                                    </button>

                                    <button class="btn btn-xs red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
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
