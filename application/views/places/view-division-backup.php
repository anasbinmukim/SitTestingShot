<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Division</h1>
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
            <span>Division</span>
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
      <div class="portlet light portlet-fit ">
          <div class="portlet-title">
              <div class="caption">
                  <i class="icon-settings font-red"></i>
                  <span class="caption-subject font-red sbold uppercase">Division</span>
              </div>
              <div class="actions">
                  <div class="btn-group btn-group-devided" data-toggle="buttons">
                      <label class="btn btn-transparent red btn-outline btn-circle btn-sm active">
                          <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                      <label class="btn btn-transparent red btn-outline btn-circle btn-sm">
                          <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                  </div>
              </div>
          </div>
          <div class="portlet-body">
              <div class="table-toolbar">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="btn-group">
                              <button id="division_editable_view_new" class="btn green"> Add New
                                  <i class="fa fa-plus"></i>
                              </button>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="btn-group pull-right">
                              <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                  <i class="fa fa-angle-down"></i>
                              </button>
                              <ul class="dropdown-menu pull-right">
                                  <li>
                                      <a href="javascript:;"> Print </a>
                                  </li>
                                  <li>
                                      <a href="javascript:;"> Save as PDF </a>
                                  </li>
                                  <li>
                                      <a href="javascript:;"> Export to Excel </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <table class="table table-striped table-hover table-bordered" id="division_editable_view" data-url="<?php echo site_url('/places/process_places'); ?>">
                  <thead>
                      <tr>
                          <th> Division Name </th>
                          <th> Edit </th>
                          <th> Delete </th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($division_rows as $division) { ?>
                        <tr>
                            <td><?php echo $division->division_name; ?></td>
                            <td><a data-action_type = "update" class="edit" href="javascript:;"> Edit </a></td>
                            <td><a data-action_type = "delete" data-division_id = "<?php echo $division->ID; ?>" data-db_table="place_division" class="delete" href="javascript:;"> Delete </a></td>
                            <input type="hidden" class="division_id" value="<?php echo $division->ID; ?>">
                            <input type="hidden" class="db_table" value="place_division">
                        </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
      <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
