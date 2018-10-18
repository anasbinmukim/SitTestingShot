<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>

<div class="row">
  <div class="col-md-12">

    <!-- Begin: life time stats -->
    <div class="portlet light portlet-fit portlet-datatable ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-green"></i>
                <span class="caption-subject font-green sbold uppercase">Thana or Upazilla</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided">
                    <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/places/add/thana'); ?>">Add New</a>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="display_thana">
                    <thead>
                        <tr>
                            <th> Thana or Upazilla </th>
                            <th> District </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                      <?php
                        $district_arr = get_district_arr();
                      ?>
                        <?php foreach ($thana_rows as $thana) { ?>
                            <?php
                              $district_name = $district_arr[$thana->district_id];
                            ?>
                            <tr>
                                <td><?php echo $thana->thana_name; ?></td>
                                <td><?php echo $district_name; ?></td>
                                <td><?php echo '<div class="center-block"><a href="'.site_url('admin/places/edit/thana/'.encrypt($thana->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this district?\');" href="'.site_url('admin/places/delete/thana/'.encrypt($thana->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                            </tr>
                          <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End: life time stats -->

  </div>
</div>
