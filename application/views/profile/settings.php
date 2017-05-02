<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">My Profile</h1>
<div class="page-bar">
    <ul class="page-breadcrumb">
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
            <span>Privacy settings</span>
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
                              <!-- PRIVACY SETTINGS TAB -->
                              <div class="tab-pane active" id="tab_1_4">
                                  <form action="" method="post">
                                      <table class="table table-light table-hover">
                                          <tr>
                                              <td> Receive Promotional Email? </td>
                                              <?php
                                                $promotional_email = $this->common->get_user_meta($this->session->userdata('user_id'), 'promotional_email');
                                              ?>
                                              <td>
                                                  <div class="mt-radio-inline">
                                                      <label class="mt-radio">
                                                          <input type="radio" name="promotional_email" <?php if($promotional_email == 'yes'){ ?> checked <?php } ?> value="yes" /> Yes
                                                          <span></span>
                                                      </label>
                                                      <label class="mt-radio">
                                                          <input type="radio" name="promotional_email" <?php if($promotional_email == 'no'){ ?> checked <?php } ?> value="no"/> No
                                                          <span></span>
                                                      </label>
                                                  </div>
                                              </td>
                                          </tr>
                                      </table>
                                      <!--end profile-settings-->
                                      <div class="margin-top-10">
                                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                          <input type="submit" class="btn red" name="privacy_settings" value="Save Changes">
                                      </div>
                                  </form>
                              </div>
                              <!-- END PRIVACY SETTINGS TAB -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- END PROFILE CONTENT -->

  </div>
</div>
