<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Companies</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Companies</span>
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
                    <span class="caption-subject bold uppercase">Companies</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('/companies/register'); ?>">Register New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="district_editable_view">
                    <thead>
                        <tr>
                            <th> Compan Name </th>
                            <th> Company Type </th>
                            <th width="50"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($company_rows as $company) { ?>
                          <tr>
                              <?php
                                $company_slug = $company->company_slug;
                              ?>
                              <td><a href="<?php echo site_url('companies/details/'.$company_slug); ?>" title=""><?php echo $company->company_name; ?></a></td>
                              <td><?php echo $company->company_type; ?></td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('/companies/edit/'.encrypt($company->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this district?\');" href="'.site_url('/companies/delete/'.encrypt($company->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
