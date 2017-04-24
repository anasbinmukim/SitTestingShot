<!-- BEGIN PAGE HEADER-->
<h1 class="page-title">Add New Places</h1>
<!-- END PAGE HEADER-->

<?php
require_once(FCPATH.'/application/views/success-error-message.php');
?>

<?php
if($add_section == 'area'){
  require_once(dirname(__FILE__) . "/add-area.php");
}elseif($add_section == 'thana'){
  require_once(dirname(__FILE__) . "/add-thana.php");
}elseif($add_section == 'district'){
  require_once(dirname(__FILE__) . "/add-district.php");
}elseif($add_section == 'division'){
  require_once(dirname(__FILE__) . "/add-division.php");
}elseif($add_section == 'zone'){
  require_once(dirname(__FILE__) . "/add-zone.php");
}else{
  require_once(dirname(__FILE__) . "/area.php");
}
?>
