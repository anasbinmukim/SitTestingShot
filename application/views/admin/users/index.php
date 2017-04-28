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
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="option1">Add New</label>
                    </div>
                    <div class="btn-group">
                        <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i>
                            <span class="hidden-xs"> Tools </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;"> Export to CSV </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;"> Print Invoices </a>
                            </li>
                        </ul>
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
                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_manage_users" data-url="<?php echo site_url('admin/users/get_all_users'); ?>">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="2%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th width="5%">&nbsp;</th>
                                <th width="200"> Name </th>
                                <th width="200"> Email </th>
                                <th width="10%"> Role </th>
                                <th width="10%"> Status </th>
                                <th width="15%"> Date </th>
                                <th width="10%"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="name"> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="email"> </td>
                                <td>
                                    <select class="form-control form-filter input-sm" name="user_role">
                                        <option value="">Select</option>
                                        <option value="administrator">Administrator</option>
                                        <option value="agent">Agent</option>
                                        <option value="company_holder">Company Holder</option>
                                        <option value="company_manager">Company Manager</option>
                                        <option value="subscriber">Subscriber</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control form-filter input-sm" name="is_active">
                                        <option value="">Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Deleted</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="reg_date" placeholder="From">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-xs green btn-outline filter-submit margin-bottom">
                                        <i class="fa fa-search"></i>
                                    </button>

                                    <button class="btn btn-xs red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: Users List Table -->



    </div>
</div>
