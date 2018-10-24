<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$request_area_url = site_url('admin/places/get_all_area');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Area</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/places/add/area'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" id="area-tb1" data-url="<?php echo $request_area_url; ?>">
                    <thead>
                        <tr>
                            <th class="all">Area name</th>
                            <th class="min-phone-l">Thana</th>
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
