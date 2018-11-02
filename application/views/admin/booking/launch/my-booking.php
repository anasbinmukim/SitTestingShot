<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');

$request_mycabin_url = site_url('admin/launchbooking/get_all_mycabin');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">My Launch Cabin Booking</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" id="mycabin-tb1" data-url="<?php echo $request_mycabin_url; ?>">
                    <thead>
                        <tr>
                            <th class="all">ID</th>
                            <th class="all">Issue Date</th>
                            <th class="all">Travel Date</th>
                            <th class="min-phone-l">Launch Name</th>
                            <th class="min-phone-l">From</th>
                            <th class="min-phone-l">To</th>
                            <th class="min-phone-l">Cabin Numbers</th>
                            <th class="none">Passenger Name</th>
                            <th class="none">Passenger Mobile</th>
                            <th class="none">Boarding Place</th>
                            <th class="none">Dropping Place</th>
                            <th class="none">Route</th>
                            <th class="none">Via Places</th>
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
