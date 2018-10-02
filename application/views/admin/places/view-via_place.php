<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
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
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/places/add/via_place'); ?>">Add New</a>
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
                            <th class="none">Place type</th>
                            <th width="20" class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($via_place_rows as $places) { ?>
                          <tr>
                              <td><?php echo $places->place_name; ?></td>
                              <td><?php echo $places->address; ?>, <?php echo $places->thana_name; ?></td>
                              <td><?php echo $places->thana_name; ?></td>
                              <td><?php echo $places->district_name; ?></td>
                              <td><?php echo $places->type; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('admin/places/edit/via_place/'.encrypt($places->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this place?\');" href="'.site_url('admin/places/delete/via_place/'.encrypt($places->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
