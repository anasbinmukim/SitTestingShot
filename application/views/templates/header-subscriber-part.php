<body class="page-container-bg-solid page-header-menu-fixed">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER -->
                <div class="page-header">
                    <!-- BEGIN HEADER TOP -->
                    <div class="page-header-top">
                        <div class="container">
                            <!-- BEGIN LOGO -->
                            <div class="page-logo">
                                <a href="<?php echo site_url();?>">
                                    <img src="<?php echo base_url('seatassets/images/logo-seat-booking-whitebg.png'); ?>" alt="Seat Booking" class="logo-default" /> </a>
                                <div class="menu-toggler sidebar-toggler">
                                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                                </div>
                            </div>
                            <!-- END LOGO -->
                            <!-- BEGIN TOP NAVIGATION MENU -->
                            <div class="top-menu">
                                <ul class="nav navbar-nav pull-right">
                                    <!-- BEGIN USER LOGIN DROPDOWN -->
                                    <?php if ( $this->session->userdata('logged_in') ) { ?>
                                      <li class="dropdown dropdown-user">
                                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                              <img alt="" class="img-circle" src="<?php echo $profile_photo; ?>" />
                                              <span class="username username-hide-on-mobile"> <?php echo $display_name; ?> </span>
                                              <i class="fa fa-angle-down"></i>
                                          </a>
                                          <ul class="dropdown-menu dropdown-menu-default">
                                              <li>
                                                  <a href="<?php echo site_url('/profile'); ?>">
                                                      <i class="icon-user"></i> My Profile </a>
                                              </li>
                                              <li>
                                                  <a href="<?php echo site_url('/booking/mybooking'); ?>">
                                                      <i class="icon-calendar"></i> My Booking </a>
                                              </li>
                                              <li class="divider"> </li>
                                              <li>
                                                  <a href="<?php echo site_url('/logout');?>">
                                                      <i class="icon-key"></i> Log Out </a>
                                              </li>
                                          </ul>
                                      </li>
                                    <?php }else{ ?>
                                        <li><a href="<?php echo site_url('/login');?>" class="btn btn-primary">Login</a></li>
                                    <?php } ?>
                                    <!-- END USER LOGIN DROPDOWN -->
                                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                                    <!-- END QUICK SIDEBAR TOGGLER -->
                                </ul>
                            </div>
                            <!-- END TOP NAVIGATION MENU -->
                        </div>
                    </div>
                    <!-- END HEADER TOP -->
                    <!-- BEGIN HEADER MENU -->
                    <div class="page-header-menu">
                        <div class="container">
                            <!-- BEGIN MEGA MENU -->
                            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                            <div class="hor-menu  ">
                                <ul class="nav navbar-nav">
                                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                        <a href="javascript:;"> Dashboard
                                            <span class="arrow"></span>
                                        </a>
                                        <ul class="dropdown-menu pull-left">
                                            <li aria-haspopup="true" class=" ">
                                                <a href="index.html" class="nav-link  ">
                                                    <i class="icon-bar-chart"></i> Default Dashboard
                                                    <span class="badge badge-success">1</span>
                                                </a>
                                            </li>
                                            <li aria-haspopup="true" class=" ">
                                                <a href="dashboard_2.html" class="nav-link  ">
                                                    <i class="icon-bulb"></i> Dashboard 2 </a>
                                            </li>
                                            <li aria-haspopup="true" class=" ">
                                                <a href="dashboard_3.html" class="nav-link  ">
                                                    <i class="icon-graph"></i> Dashboard 3
                                                    <span class="badge badge-danger">3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- END MEGA MENU -->
                        </div>
                    </div>
                    <!-- END HEADER MENU -->
                </div>
                <!-- END HEADER -->
            </div>
        </div>

        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container">
                                <!-- BEGIN PAGE CONTENT INNER -->
