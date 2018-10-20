<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$request_account_url = site_url('admin/accounts/get_all/');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Transactions</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="accounts-tbl" data-url="<?php echo $request_account_url; ?>">
                    <thead>
                        <tr>
                            <th class="all">ID</th>
                            <th class="all">Date</th>
                            <th class="min-phone-l">Type</th>
                            <th class="min-phone-l">Name</th>
                            <th class="all">Gross Amount</th>
                            <th class="all">Balance</th>
                            <th width="20" class="all">Action</th>
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
