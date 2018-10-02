<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $title; ?> | <?php echo $site_title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url('assets/global/css/components.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url('assets/global/css/plugins.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN PAGE LEVEL STYLES -->
        <!-- END PAGE LEVEL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <?php if(($this->session->userdata('user_role') == ROLE_ADMINISTRATOR)){ ?>
          <link href="<?php echo base_url('assets/layouts/layout2/css/layout.min.css');?>" rel="stylesheet" type="text/css" />
        <?php }else{ ?>
          <link href="<?php echo base_url('assets/layouts/layout3/css/layout.min.css');?>" rel="stylesheet" type="text/css" />
          <link href="<?php echo base_url('assets/layouts/layout3/css/themes/default.min.css');?>" rel="stylesheet" type="text/css" id="style_color" />
        <?php } ?>
        <!-- END THEME LAYOUT STYLES -->

        <!-- BEGIN APP STYLES -->
        <link href="<?php echo base_url('seatassets/green.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('seatassets/seat-booking.css');?>" rel="stylesheet" type="text/css" />
        <!-- END APP STYLES -->
        <?php if( isset($css_files)) { foreach( $css_files as $css ){ ?>
            <link href="<?php echo $css;?>" media="all" rel="stylesheet" type="text/css" />
        <?php }} ?>
        <link rel="shortcut icon" href="favicon.ico" />
        <script>var base_url = '<?php echo base_url();?>';</script>
        <script>var site_url = '<?php echo site_url();?>';</script>
        <script type="text/javascript">
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <script type="text/javascript">
        var seat_options = seat_options || {};
        <?php
          foreach ($front_js_flag as $key => $value) {
            echo 'seat_options.'.$key.' = '.$value . ';';
          }
        ?>
        </script>
   </head>
    <!-- END HEAD -->
    <?php
    if(($this->session->userdata('user_role') == ROLE_ADMINISTRATOR)){
        require_once(FCPATH.'/application/views/templates/header-admin-part.php');
    }else{
        require_once(FCPATH.'/application/views/templates/header-subscriber-part.php');
    }
    ?>
