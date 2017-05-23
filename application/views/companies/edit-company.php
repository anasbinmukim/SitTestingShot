<?php
require_once(FCPATH.'/application/views/breadcrumb.php');
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
                              <span class="caption-subject font-blue-madison bold uppercase">Edit Company</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Company name</label>
                                        <input type="text" name="company_name" class="form-control" value="<?php echo html_escape($company_data['company_name']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Address</label>
                                        <textarea class="form-control" name="company_address"> <?php echo html_escape($company_data['company_address']); ?> </textarea></div>
                                    <div class="form-group">
                                        <label class="control-label">Company phone</label>
                                        <input type="text" name="company_phone" class="form-control" value="<?php echo html_escape($company_data['company_phone']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company mobile</label>
                                        <input type="text" name="company_mobile" class="form-control" value="<?php echo html_escape($company_data['company_mobile']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Email</label>
                                        <input type="text" name="company_email" class="form-control" value="<?php echo html_escape($company_data['company_email']); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Type</label>
                                        <select name="company_type" id="company_type" class="form-control">
                                          <?php $company_type = $company_data['company_type']; ?>
                                          <option value="">Select One</option>
                                          <option <?php if($company_type == 'Launch'){ ?> selected="selected" <?php } ?> value="Launch">Launch</option>
                                          <option <?php if($company_type == 'Bus'){ ?> selected="selected" <?php } ?> value="Bus">Bus</option>
                                          <option <?php if($company_type == 'Medical'){ ?> selected="selected" <?php } ?> value="Medical">Medical</option>
                                          <option <?php if($company_type == 'Others'){ ?> selected="selected" <?php } ?> value="Others">Others</option>
                                        </select>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Company Logo</label>
                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                              <?php
                                                $company_logo = base_url('seatassets/images/placeholder-profile-photo.jpg');
                                                $company_logo = $company_data['company_logo'];
                                                if( $company_logo && file_exists( getcwd().'/files/company/'.$company_logo ) ){
                                      							$company_logo = base_url( 'files/company/'.$company_logo );
                                      					}
                                              ?>
                                              <img src="<?php echo $company_logo; ?>" alt="" /> </div>
                                          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                          <div>
                                              <span class="btn default btn-file">
                                                  <span class="fileinput-new"> Select Logo </span>
                                                  <span class="fileinput-exists"> Change </span>
                                                  <input type="file" name="company_logo"> </span>
                                              <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                          </div>
                                          <div class="clearfix margin-top-10">
                                             <span>Max size : 600X600, File Type: JPG, PNG, GIF</span>
                                          </div>
                                          <input type="hidden" name="company_logo_name" value="<?php echo $company_data['company_logo']; ?>" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Select Withdrawal Method</label>
                                      <select name="withdrawal_method" id="withdrawal_method" class="form-control">
                                        <?php $withdrawal_method = $company_data['withdrawal_method']; ?>
                                        <option value="">Select One</option>
                                        <option <?php if($withdrawal_method == 'bank_transper'){ ?> selected="selected" <?php } ?> value="bank_transper">Bank Transper</option>
                                        <option <?php if($withdrawal_method == 'check'){ ?> selected="selected" <?php } ?> value="check">Bank Check</option>
                                        <option <?php if($withdrawal_method == 'bkash'){ ?> selected="selected" <?php } ?> value="bkash">bKash</option>
                                        <option <?php if($withdrawal_method == 'cash'){ ?> selected="selected" <?php } ?> value="cash">Cash</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Company Bank Account</label>
                                      <textarea class="form-control" name="company_bank_account"><?php echo html_escape($company_data['company_bank_account']); ?></textarea></div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">About Company</label>
                                      <textarea class="form-control ckeditor" name="company_description"><?php echo html_escape($company_data['company_description']); ?></textarea></div>
                                  <div class="margin-top-10">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                      <input type="hidden" name="update_company_id" value="<?php echo $company_data['ID']; ?>">
                                      <input type="submit" class="btn green" name="update_company" value="Update Now">
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
