<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$request_counter_url = site_url('admin/counters/get_all/');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Company Counter</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/counters/register'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" id="counters-tb1" data-url="<?php echo $request_counter_url; ?>">
                    <thead>
                        <tr>
                            <th class="all">Counter name</th>
                            <th class="min-phone-l">Address</th>
                            <th class="min-phone-l">Details</th>
                            <th class="none">Company Name</th>
                            <th class="none">Incharge</th>
                            <th class="none">Mobile</th>
                            <th class="none">Thana</th>
                            <th class="none">District</th>
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
