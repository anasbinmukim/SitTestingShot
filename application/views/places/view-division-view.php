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
          </div>
          <div class="portlet-body">
              <table class="table table-striped table-hover table-bordered">
                  <tbody>
                    <?php foreach ($division_rows as $division) { ?>
                        <tr>
                            <td><?php echo $division->division_name; ?></td>
                        </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
      <!-- END EXAMPLE TABLE PORTLET-->
  </div>
</div>
