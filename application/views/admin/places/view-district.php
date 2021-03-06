<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <div class="portlet light portlet-fit ">
          <div class="portlet-title">
              <div class="caption">
                  <i class="icon-settings font-red"></i>
                  <span class="caption-subject font-red sbold uppercase">District</span>
              </div>
              <div class="actions">
                  <div class="btn-group btn-group-devided">
                      <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/places/add/district'); ?>">Add New</a>
                  </div>
              </div>
          </div>
          <div class="portlet-body">
              <table class="table table-striped table-hover table-bordered" id="district_editable_view" data-url="<?php echo site_url('admin/places/process_places'); ?>">
                  <thead>
                      <tr>
                          <th> District Name </th>
                          <th> Division </th>
                          <th style="display:none;"> Edit </th>
                          <th width="50"> Action </th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php
                    $division_arr = get_divisions_arr();
                  ?>
                    <?php foreach ($district_rows as $district) { ?>
                        <?php
                          $division_name = $division_arr[$district->division_id];
                        ?>
                        <tr>
                            <td><?php echo $district->district_name; ?></td>
                            <td><?php echo $division_name; ?></td>
                            <td style="display:none;"></td>
                            <td><?php echo '<div class="center-block"><a href="'.site_url('admin/places/edit/district/'.encrypt($district->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this district?\');" href="'.site_url('admin/places/delete/district/'.encrypt($district->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                        </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
      <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
