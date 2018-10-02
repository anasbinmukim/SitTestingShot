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
                              <span class="caption-subject font-blue-madison bold uppercase"><?php echo html_escape($counter_data['counter_name']); ?></span>
                          </div>
                      </div>
                      <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Address</label>
                                        <textarea class="form-control" name="company_address"> <?php echo set_value('company_address'); ?> </textarea></div>
                                    <div class="form-group">
                                        <label class="control-label">Company phone</label>
                                        <input type="text" name="company_phone" class="form-control" value="<?php echo set_value('company_phone'); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company mobile</label>
                                        <input type="text" name="company_mobile" class="form-control" value="<?php echo set_value('company_mobile'); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Email</label>
                                        <input type="text" name="company_email" class="form-control" value="<?php echo set_value('company_email'); ?>" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Company Type</label>
                                        <select name="company_type" id="company_type" class="form-control">
                                          <option value="">Select One</option>
                                          <option value="Launch">Launch</option>
                                          <option value="Bus">Bus</option>
                                          <option value="Medical">Medical</option>
                                          <option value="Others">Others</option>
                                        </select>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Company Logo</label>
                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                              <img src="<?php //echo $profile_photo;?>" alt="" /> </div>
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
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Select Withdrawal Method</label>
                                      <select name="withdrawal_method" id="withdrawal_method" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="bank_transper">Bank Transper</option>
                                        <option value="check">Bank Check</option>
                                        <option value="bkash">bKash</option>
                                        <option value="Cash">Cash</option>
                                        <option value="check">Bank Check</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label">Company Bank Account</label>
                                      <textarea class="form-control" name="company_bank_account"><?php echo set_value('company_bank_account'); ?></textarea></div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">About Company</label>
                                      <textarea class="form-control ckeditor" name="company_description"><?php echo set_value('company_description'); ?></textarea></div>
                                  <div class="margin-top-10">
                                      <input type="submit" class="btn green" name="register_new_company" value="Register Now">
                                  </div>
                              </div>
                            </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
