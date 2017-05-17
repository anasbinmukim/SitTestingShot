<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">My Profile</h1>
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url(); ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="<?php echo site_url('profile'); ?>">Profile</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Personal Information</span>
        </li>
    </ul>
</div>
<!-- END PAGE HEADER-->

<?php
require_once(FCPATH.'/application/views/success-error-message.php');
?>
<div class="row">
    <div class="col-md-12">
      <?php require_once(dirname(__FILE__) . "/profile-view-widget.php"); ?>
      <!-- BEGIN PROFILE CONTENT -->
      <div class="profile-content">
          <div class="row">
              <div class="col-md-12">
                  <div class="portlet light ">
                      <div class="portlet-title tabbable-line">
                          <div class="caption caption-md">
                              <i class="icon-globe theme-font hide"></i>
                              <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                          </div>
                          <?php require_once(dirname(__FILE__) . "/profile-tab-nav.php"); ?>
                      </div>
                      <div class="portlet-body">
                          <div class="tab-content">
                              <!-- PERSONAL INFO TAB -->
                              <div class="tab-pane active" id="tab_1_1">
                                  <form method="post" role="form" action="">
                                    <?php
                                      $user_profile = $this->common->get( 'users', array( 'ID' => $this->session->userdata('user_id') ) );

                                    ?>

                                      <div class="form-group">
                                          <label class="control-label">User/Login Name</label>
                                          <input type="text" readonly="" value="<?php echo $user_profile->user_name; ?>" placeholder="John" class="form-control" /> </div>

                                      <div class="form-group">
                                          <label class="control-label">First Name</label>
                                          <input type="text" name="first_name" value="<?php echo html_escape($user_profile->first_name); ?>" placeholder="John" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Last Name</label>
                                          <input type="text" name="last_name" value="<?php echo html_escape($user_profile->last_name); ?>" placeholder="Doe" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Display Name</label>
                                          <input type="text" name="display_name" value="<?php echo html_escape($user_profile->display_name); ?>" placeholder="John Doe" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Email</label>
                                          <input type="text" name="email" value="<?php echo html_escape($user_profile->email); ?>" placeholder="info@company.com" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Mobile Number</label>
                                          <input type="text" name="mobile" value="<?php echo html_escape($user_profile->mobile); ?>" placeholder="01719999999" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Alternate Mobile Number</label>
                                          <input type="text" name="mobile_2" value="<?php echo html_escape($user_profile->mobile_2); ?>" placeholder="01719999999" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Phone home</label>
                                          <input type="text" name="phone_home" value="<?php echo html_escape($user_profile->phone_home); ?>" placeholder="02783749" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Phone office</label>
                                          <input type="text" name="phone_office" value="<?php echo html_escape($user_profile->phone_office); ?>" placeholder="02783749" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Occupation</label>
                                          <input type="text" name="occupation" value="<?php echo html_escape($user_profile->occupation); ?>" placeholder="Manager" class="form-control" /> </div>
                                      <div class="form-group">
                                          <label class="control-label">Bio</label>
                                          <textarea name="bio_info" class="form-control" rows="3" placeholder="I'm John and team lead of RM Corporation.."><?php echo html_escape($this->common->get_user_meta($this->session->userdata('user_id'), 'bio_info')); ?></textarea>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label">Website URL</label>
                                          <input type="text" name="web_url" value="<?php echo html_escape($user_profile->web_url); ?>" placeholder="http://www.mywebsite.com" class="form-control" /> </div>
                                      <div class="margiv-top-10">
                                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                          <input type="submit" class="btn green" name="save_personal_info" value="Save Changes">
                                      </div>
                                  </form>
                              </div>
                              <!-- END PERSONAL INFO TAB -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
