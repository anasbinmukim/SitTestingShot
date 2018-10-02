<?php $edit_user_profile = $this->common->get( 'users', array( 'ID' => $edit_user_id ) ); ?>
<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Update User</h1>
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
            <span><?php echo html_escape($edit_user_profile->first_name); ?></span>
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
              <div class="col-md-6">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Update Personal Info</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                            <form method="post" role="form" action="">

                                <div class="form-group">
                                    <label class="control-label">User/Login Name</label>
                                    <input type="text" readonly="" value="<?php echo $edit_user_profile->user_name; ?>" placeholder="John" class="form-control" /> </div>

                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" name="first_name" value="<?php echo html_escape($edit_user_profile->first_name); ?>" placeholder="John" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" name="last_name" value="<?php echo html_escape($edit_user_profile->last_name); ?>" placeholder="Doe" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Display Name</label>
                                    <input type="text" name="display_name" value="<?php echo html_escape($edit_user_profile->display_name); ?>" placeholder="John Doe" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="email" value="<?php echo html_escape($edit_user_profile->email); ?>" placeholder="info@company.com" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Mobile Number</label>
                                    <input type="text" name="mobile" value="<?php echo html_escape($edit_user_profile->mobile); ?>" placeholder="01719999999" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Alternate Mobile Number</label>
                                    <input type="text" name="mobile_2" value="<?php echo html_escape($edit_user_profile->mobile_2); ?>" placeholder="01719999999" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Phone home</label>
                                    <input type="text" name="phone_home" value="<?php echo html_escape($edit_user_profile->phone_home); ?>" placeholder="02783749" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Phone office</label>
                                    <input type="text" name="phone_office" value="<?php echo html_escape($edit_user_profile->phone_office); ?>" placeholder="02783749" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Occupation</label>
                                    <input type="text" name="occupation" value="<?php echo html_escape($edit_user_profile->occupation); ?>" placeholder="Manager" class="form-control" /> </div>
                                <div class="form-group">
                                    <label class="control-label">Bio</label>
                                    <textarea name="bio_info" class="form-control" rows="3" placeholder="I'm John and team lead of RM Corporation.."><?php echo html_escape($this->common->get_user_meta($edit_user_id, 'bio_info')); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Website URL</label>
                                    <input type="text" name="web_url" value="<?php echo html_escape($edit_user_profile->web_url); ?>" placeholder="http://www.mywebsite.com" class="form-control" /> </div>
                                <div class="margiv-top-10">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <input type="hidden" name="update_user_id" value="<?php echo $edit_user_profile->ID; ?>" />
                                    <input type="submit" class="btn green" name="update_personal_info" value="Update Personal Info">
                                </div>
                            </form>
                      </div>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Update Settings</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <select name="is_active" id="is_active" class="form-control">
                                  <?php $is_active = $edit_user_profile->is_active; ?>
                                  <option value="">Select One</option>
                                  <option <?php if($is_active == 1){ ?> selected="selected" <?php } ?> value="1">Active</option>
                                  <option <?php if($is_active == 2){ ?> selected="selected" <?php } ?> value="2">Inactive</option>
                                  <option <?php if($is_active == 3){ ?> selected="selected" <?php } ?> value="2">Deleted</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Role</label>
                                <select name="user_role" id="user_role" class="form-control">
                                  <option value="">Select One</option>
                                  <?php $user_role = $edit_user_profile->user_role; ?>
                                  <?php
                                    $all_user_role = get_user_role('all');
                                    foreach ($all_user_role as $role_key => $role_value) {
                                      $selected = '';
                                      if($user_role == $role_key){
                                        $selected = ' selected="selected" ';
                                      }
                                      echo '<option '. $selected .' value="'.$role_key.'">'.$role_value.'</option>';
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="margin-top-10">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="update_user_id" value="<?php echo $edit_user_profile->ID; ?>" />
                                <input type="submit" class="btn red" name="update_user_access" value="Update Access">
                            </div>
                        </form>
                      </div>
                  </div>
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Update Password</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post">
                              <div class="form-group">
                                  <label class="control-label">New Password</label>
                                  <input type="password" name="password" class="form-control" /> </div>
                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="hidden" name="update_user_id" value="<?php echo $edit_user_profile->ID; ?>" />
                                  <input type="submit" class="btn green" name="reset_password" value="Reset Password">
                              </div>
                          </form>
                      </div>
                  </div>

                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Update Profile Photo</span>
                          </div>
                      </div>
                      <div class="portlet-body">
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="form-group">
                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                          <?php
                                          $profile_photo = $edit_user_profile->profile_photo;
                                          if( $profile_photo && file_exists( getcwd().'/files/profile/'.$profile_photo ) ){
                                              $profile_photo = base_url( 'files/profile/'.$profile_photo );
                                          }
                                          ?>
                                          <img src="<?php echo $profile_photo; ?>" alt="" /> </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                      <div>
                                          <span class="btn default btn-file">
                                              <span class="fileinput-new"> Select image </span>
                                              <span class="fileinput-exists"> Change </span>
                                              <input type="file" name="profile_photo"> </span>
                                          <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                      </div>
                                      <div class="clearfix margin-top-10">
                                         <span>Max size : 600X600, File Type: JPG, PNG, GIF</span>
                                      </div>
                                  </div>
                              </div>
                              <div class="margin-top-10">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                  <input type="hidden" name="update_user_id" value="<?php echo $edit_user_profile->ID; ?>" />
                                  <input type="submit" class="btn green" name="update_user_photo" value="Update User Photo">
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
