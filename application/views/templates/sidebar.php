<?php
if(($this->session->userdata('user_role') == ROLE_ADMINISTRATOR)){
    require_once(FCPATH.'/application/views/templates/sidebar-admin.php');
}else{
    //No sidebar for subscriber or non logged user
}
?>
