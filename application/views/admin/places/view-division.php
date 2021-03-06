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
                <span class="caption-subject font-green sbold uppercase">Division</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="display_thana">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Division Name </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($division_rows as $division) { ?>
                            <tr>
                                <td><?php echo $division->ID; ?></td>
                                <td><?php echo $division->division_name; ?></td>
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
