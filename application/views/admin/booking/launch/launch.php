<?php
require_once(FCPATH.'/application/views/success-error-message.php');

$request_booking_url = site_url('admin/launchbooking/get_all');

?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Available Launch</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" id="schedule-tb1" data-url="<?php echo $request_booking_url; ?>">
                    <thead>
                        <tr>
                            <th class="all">Launch Name</th>
                            <th class="min-phone-l">Date</th>
                            <th class="min-phone-l">From</th>
                            <th class="min-phone-l">To</th>
                            <th class="none">Route</th>
                            <th class="none">Start Time</th>
                            <th class="none">Destination Time</th>
                            <th width="20" class="all">Available</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
              </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
