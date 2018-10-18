<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Deposit To User Accounts</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('companies'); ?>">Accounts</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Deposit</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->
<?php
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Accounts Deposit</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Select User</label>
                                      <select name="user_solt_id" id="user_solt_id" class="form-control select2me">
                                      <?php
                                        foreach($all_users as $ukey => $uvalue){
                                          echo '<option value="'.encrypt($ukey).'">'.$uvalue.'</option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Deposit Amount</label>
                                        <div class="input-group input-icon right">
                                            <span class="input-group-addon">
                                                TK
                                            </span>
                                            <input id="deposit_amount" name="deposit_amount" class="input-error form-control" type="text" value="<?php echo set_value('deposit_amount'); ?>"> </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label class="control-label" style="visibility: hidden;">Submit deposit to your account</label>
                                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                          <input type="submit" class="btn green" name="deposit_to_user_account" value="Deposit Now">
                                      </div>
                                  </div>
                            </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
