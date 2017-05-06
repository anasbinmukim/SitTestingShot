<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Via Places</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('places'); ?>">Places</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Via Places</span>
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
                    <span class="caption-subject bold uppercase">Via Places</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/places/add/via_place'); ?>">Add New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="table_area">
                    <thead>
                        <tr>
                            <th class="all">Place name</th>
                            <th class="min-phone-l">Address</th>
                            <th class="none">Thana</th>
                            <th class="none">District</th>
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $thana_arr = get_thana_arr();
                        $district_arr = get_district_arr();
                      ?>
                      <?php foreach ($via_place_rows as $places) { ?>
                          <?php
                            $thana_name = $thana_arr[$places->thana_id];
                            $district_name = $district_arr[$places->district_id];
                          ?>
                          <tr>
                              <td><?php echo $places->place_name; ?></td>
                              <td><?php echo $places->address; ?>, <?php echo $thana_name; ?>, <?php echo $district_name; ?></td>
                              <td><?php echo $thana_name; ?></td>
                              <td><?php echo $district_name; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('places/edit/via_place/'.encrypt($places->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this place?\');" href="'.site_url('places/delete/via_place/'.encrypt($places->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
