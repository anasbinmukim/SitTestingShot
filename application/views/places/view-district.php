<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Districts of Bangladesh</h1>
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
            <span>District</span>
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
                  <span class="caption-subject font-red sbold uppercase">District</span>
              </div>
          </div>
          <div class="portlet-body">
              <table class="table table-striped table-hover table-bordered" id="district_editable_view" data-url="<?php echo site_url('/places/process_places'); ?>">
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
                            <td><?php echo '<div class="center-block"><a href="'.site_url('places/edit/district/'.encrypt($district->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a href="'.site_url('places/delete/district/'.encrypt($district->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                        </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
      <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
