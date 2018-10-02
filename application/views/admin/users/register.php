<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Add New User</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('admin/users'); ?>">Users</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>New user</span>
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
                              <span class="caption-subject font-blue-madison bold uppercase">Personal Info</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                            <form method="post" role="form" action="">

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">User/Login Name</label>
                                        <input type="text" name="username" value="<?php echo set_value('username'); ?>" placeholder="John" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" placeholder="John" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" placeholder="Doe" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Display Name</label>
                                        <input type="text" name="display_name" value="<?php echo set_value('display_name'); ?>" placeholder="John Doe" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="info@company.com" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <input type="password" name="password" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Re-type New Password</label>
                                        <input type="password" name="conf_password" class="form-control" /> </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mobile Number</label>
                                        <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="01719999999" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Alternate Mobile Number</label>
                                        <input type="text" name="mobile_2" value="<?php echo set_value('mobile_2'); ?>" placeholder="01719999999" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Phone home</label>
                                        <input type="text" name="phone_home" value="<?php echo set_value('phone_home'); ?>" placeholder="02783749" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Phone office</label>
                                        <input type="text" name="phone_office" value="<?php echo set_value('phone_office'); ?>" placeholder="02783749" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Occupation</label>
                                        <input type="text" name="occupation" value="<?php echo set_value('occupation'); ?>" placeholder="Manager" class="form-control" /> </div>
                                    <div class="form-group">
                                        <label class="control-label">Website URL</label>
                                        <input type="text" name="web_url" value="<?php echo set_value('web_url'); ?>" placeholder="http://www.mywebsite.com" class="form-control" /> </div>

                                    <div class="form-group">
                                        <label class="control-label">Role</label>
                                        <select name="user_role" id="user_role" class="form-control">
                                          <option value="">Select One</option>
                                          <?php
                                            $all_user_role = get_user_role('all');
                                            foreach ($all_user_role as $role_key => $role_value) {
                                              echo '<option value="'.$role_key.'">'.$role_value.'</option>';
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="margiv-top-10 form-actions right">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <input type="submit" class="btn green" name="add_new_user" value="Add New User">
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
