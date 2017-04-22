<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">My Profile</h1>
<!-- END PAGE HEADER-->

<?php if($this->session->flashdata('success_msg')): ?>
  <div class="note note-success">
      <p> <?php echo $this->session->flashdata('success_msg'); ?> </p>
  </div>
<? endif ?>

<?php if($this->session->flashdata('error_msg')): ?>
  <div class="alert alert-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('error_msg'); ?> </div>
<? endif ?>

<?php
$error_message = $this->session->flashdata('error_msg_arr');
if(!empty($error_message)){
  foreach ($error_message as $key => $value) {
    ?>
    <div class="alert alert-danger"><strong>Error!</strong> <?php echo $value; ?> </div>
    <?php
  }
}
?>

<?php
  if($profile_section == 'personal-info'){
    require_once(dirname(__FILE__) . "/profile-personal-info.php");
  }elseif($profile_section == 'profile-photo'){
    require_once(dirname(__FILE__) . "/profile-photo.php");
  }elseif($profile_section == 'profile-settings'){
    require_once(dirname(__FILE__) . "/profile-settings.php");
  }elseif($profile_section == 'update-password'){
    require_once(dirname(__FILE__) . "/profile-password.php");
  }else{
    require_once(dirname(__FILE__) . "/profile-personal-info.php");
  }
?>
