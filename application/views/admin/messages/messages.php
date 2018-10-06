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
                    <span class="caption-subject bold uppercase">Messages</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided">
                        <a class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm" href="<?php echo site_url('admin/messages/register'); ?>">Register New</a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="district_editable_view">
                    <thead>
                        <tr>
                            <th> Message Subject </th>
                            <th> Message Excerpt </th>
                            <th> Message Content </th>
                            <th width="50"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($message_rows as $message) { ?>
                          <tr>
                              <?php
                                //$company_slug = $company->company_slug;
                              ?>
                              <td><?php echo $message->msg_subject; ?></td>
                              <td><?php echo $message->msg_excerpt; ?></td>
                              <td><?php echo $message->msg_content; ?> </td>
                              <td><?php echo '<div class="center-block"><a href="'.site_url('admin/messages/edit/'.encrypt($message->ID)).'" title="Edit"><i class="fa fa-edit font-blue-ebonyclay"></i></a>&nbsp;&nbsp;<a onclick="return confirm(\'Are you sure you want to delete this message?\');" href="'.site_url('admin/messages/delete/'.encrypt($message->ID)).'" title="Delete"><i class="fa fa-trash-o text-danger"></i></a></div>'; ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>
                </table>				
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>