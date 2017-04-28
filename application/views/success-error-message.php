<?php if($this->session->flashdata('success_msg')): ?>
  <div class="note note-success">
      <p> <?php echo $this->session->flashdata('success_msg'); ?> </p>
  </div>
<?php endif; ?>

<?php if($this->session->flashdata('error_msg')): ?>
  <div class="alert alert-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('error_msg'); ?> </div>
<?php endif; ?>

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
