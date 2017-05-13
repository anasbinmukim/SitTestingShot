<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Accounts</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Accounts</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<?php
require_once(FCPATH.'/application/views/success-error-message.php');
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
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">ID</th>
                            <th class="all">Date</th>
                            <th class="min-phone-l">Type</th>
                            <th class="min-phone-l">Name</th>
                            <th width="100" class="all">Gross Amount</th>
                            <th width="100" class="all">Balance</th>
                            <!-- <th class="none">Company Name</th>
                            <th class="none">Incharge</th>
                            <th class="none">Mobile</th>
                            <th class="none">Thana</th>
                            <th class="none">District</th> -->
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($transactions_rows as $transactions) { ?>
                          <?php
                            $formatted_id = sprintf("%08d", $transactions->ID);
                          ?>
                          <tr>
                              <td><?php echo $formatted_id; ?></td>
                              <td><?php echo $transactions->transaction_date; ?></td>
                              <td><?php echo $transactions->transaction_type; ?></td>
                              <td><?php echo $transactions->transaction_for; ?></td>
                              <td style="text-align:right;"><?php echo seat_taka_format($transactions->gross_amount); ?></td>
                              <td style="text-align:right;"><?php echo seat_taka_format($transactions->balance); ?></td>
                              <!-- <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td> -->
                              <td><?php echo '<div class="center-block"><a onclick="return confirm(\'Are you sure you want to delete this transaction?\');" href="'.site_url('accounts/delete/'.encrypt($transactions->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
