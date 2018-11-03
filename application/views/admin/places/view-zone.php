<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
  <div class="col-md-12">
      <!-- BEGIN EXAMPLE TABLE PORTLET-->
      <div class="portlet light portlet-fit ">
          <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Zone</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/places/add/zone'); ?>">Add New</a>
                    </div>
                </div>
            </div>
          <div class="portlet-body">             
              <table class="table table-striped table-hover table-bordered" id="division_editable_view">
                  <thead>
                      <tr>
                          <th>Name </th>
                          <th> District Name </th>
                          <th> Action </th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($zone_rows as $zone) { ?>
                        <tr>
                            <td><?php echo $zone->zone_name; ?></td>
                            <td><?php echo $zone->district_name; ?></td>
                            <td><a href="<?php echo site_url('admin/places/edit/zone/'.encrypt($zone->ID))?>" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this area?\');" href="<?php echo site_url('admin/places/delete/zone/'.encrypt($zone->ID))?>" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></td>                            
                        </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
      <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
