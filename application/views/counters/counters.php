<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Companies Counters</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Counters</span>
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
                    <span class="caption-subject bold uppercase">Company Counter</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/counters/register'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
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
                      <?php foreach ($counter_rows as $counter) { ?>
                          <tr>
                            <?php
                              $counter_slug = $counter->counter_slug;
                            ?>
                              <td><?php echo $counter->counter_name; ?></td>
                              <td><?php echo $counter->address; ?></td>
                              <td><a href="<?php echo site_url('counters/details/'.$counter_slug); ?>" title="">Details</a></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('counters/edit/'.encrypt($counter->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this counter?\');" href="'.site_url('counters/delete/'.encrypt($counter->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
