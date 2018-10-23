<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$launch_id = $this->uri->segment(5);
if($launch_id != null){
	$request_cabin_url = site_url('admin/launch/get_all_cabin/'.$launch_id);
}else{
	$request_cabin_url = site_url('admin/launch/get_all_cabin/');
}

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
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/launch/cabin/register'); ?>">Add New Cabin</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" id="cabin-tb1" data-url="<?php echo $request_cabin_url; ?>">
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
                      
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
