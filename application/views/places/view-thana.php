<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Thana/Upzilla of Bangladesh</h1>
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
            <span>Thana</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<?php
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
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="display_thana">
                    <thead>
                        <tr>
                            <th> Thana or Upazilla </th>
                            <th> District </th>
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
