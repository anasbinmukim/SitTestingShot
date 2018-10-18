<?php
$current_view_places = $current_home = $current_view_thana = $current_launch = $current_cabin = '';
$current_schedule = $current_route = $current_search_cabins = $current_my_cabin_booking = $current_company = '';
$current_counters = $current_messages = $current_notifications = $current_sadf = $current_asdfa = '';
$current_dfsafsa = $current_asdfasdf = $current_sadfasf = $current_sadf = $current_asdfa = '';
$current_dfsafsa = $current_asdfasdf = $current_sadfasf = $current_sadf = $current_asdfa = '';
$current_dfsafsa = $current_asdfasdf = $current_sadfasf = $current_sadf = $current_asdfa = '';
$current_dfsafsa = $current_asdfasdf = $current_sadfasf = $current_sadf = $current_asdfa = '';
$current_dfsafsa = $current_asdfasdf = $current_sadfasf = $current_sadf = $current_asdfa = '';

$current_page_class = ' active open';

if($current_page == 'places'){ $current_view_places = ' active open'; }
if($current_page == 'view_thana'){ $current_view_thana = ' active open'; $current_view_places = ' active open'; }
if($current_page == 'home'){ $current_home = ' active open'; }

if(($current_page == 'launch')
|| ($current_page == 'register_launch')
|| ($current_page == 'cabin')
|| ($current_page == 'cabin_register')
|| ($current_page == 'cabin_edit')
|| ($current_page == 'schedule')
|| ($current_page == 'schedule_add')
|| ($current_page == 'schedule_edit')
|| ($current_page == 'route')
|| ($current_page == 'route_add')
|| ($current_page == 'route_edit')
|| ($current_page == 'search_cabins')
|| ($current_page == 'my_cabin_booking')
|| ($current_page == 'edit_launch')){ $current_launch = ' active open'; }

if(($current_page == 'cabin') || ($current_page == 'cabin_register') || ($current_page == 'cabin_edit')){ $current_cabin = ' active open'; }
if(($current_page == 'schedule') || ($current_page == 'schedule_add') || ($current_page == 'schedule_edit')){ $current_schedule = ' active open'; }
if(($current_page == 'route') || ($current_page == 'route_add') || ($current_page == 'route_edit')){ $current_route = ' active open'; }
if($current_page == 'search_cabins'){ $current_search_cabins = ' active open'; }
if($current_page == 'my_cabin_booking'){ $current_my_cabin_booking = ' active open'; }
if(($current_page == 'companies')
|| ($current_page == 'counters')
|| ($current_page == 'counter_details')
|| ($current_page == 'counter_add')
|| ($current_page == 'counter_edit')
|| ($current_page == 'company_details')
|| ($current_page == 'add_company')
|| ($current_page == 'edit_company')){ $current_company = ' active open'; }
if(($current_page == 'counters') || ($current_page == 'counter_details') || ($current_page == 'counter_add') || ($current_page == 'counter_edit')){ $current_route = ' active open'; }
if(($current_page == 'messages')||($current_page == 'add_message')||($current_page == 'message_details')){ $current_messages = ' active open'; }
if($current_page == 'notifications'){ $current_notifications = ' active open'; }



?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start <?php echo $current_home; ?>">
                <a href="<?php echo site_url(); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard <?php echo $current_page; ?></span>
                    <span class="arrow"></span>
                </a>

            </li>
            <li class="nav-item <?php echo $current_launch; ?>">
                <a href="<?php echo site_url('admin/launch'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Launch</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  <?php echo $current_cabin; ?>">
                        <a href="<?php echo site_url('admin/launch/cabin'); ?>" class="nav-link ">
                            <span class="title">Cabin</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $current_schedule; ?>">
                        <a href="<?php echo site_url('admin/launch/schedule'); ?>" class="nav-link ">
                            <span class="title">Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $current_route; ?>">
                        <a href="<?php echo site_url('admin/launch/route'); ?>" class="nav-link ">
                            <span class="title">Route</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php echo $current_search_cabins; ?>">
                        <a href="<?php echo site_url('LaunchBooking'); ?>" class="nav-link ">
                            <span class="title">Booking</span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo $current_my_cabin_booking; ?>">
                        <a href="<?php echo site_url('LaunchBooking/MyCabin'); ?>" class="nav-link ">
                            <span class="title">My Cabin</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  <?php echo $current_company; ?>">
                <a href="<?php echo site_url('admin/companies'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Companies</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  <?php echo $current_counters; ?>">
                        <a href="<?php echo site_url('admin/counters'); ?>" class="nav-link nav-toggle">
                            <i class="icon-diamond"></i>
                            <span class="title">Counters</span>
                            <span class="arrow"></span>
                        </a>
                    </li>
                </ul>
            </li>
			<li class="nav-item  <?php echo $current_messages; ?>">
                <a href="<?php echo site_url('admin/messages'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Messages</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  <?php echo $current_messages; ?>">
                        <a href="<?php echo site_url('admin/messages/register'); ?>" class="nav-link nav-toggle">
                            <i class="icon-diamond"></i>
                            <span class="title">Add New</span>
                            <span class="arrow"></span>
                        </a>
                    </li>
                </ul>
            </li>
			<li class="nav-item  <?php echo $current_notifications; ?>">
                <a href="<?php echo site_url('admin/notifications'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Notifications</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item <?php echo $current_view_places; ?>">
                <a href="<?php echo site_url('admin/places'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Places</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">Add New</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item ">
                                <a href="<?php echo site_url('admin/places/add/area'); ?>" class="nav-link ">Area</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('admin/places/add/via_place'); ?>" class="nav-link ">Via Place</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('admin/places/add/thana'); ?>" class="nav-link ">Thana</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('admin/places/add/district'); ?>" class="nav-link ">District</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('admin/places/add/division'); ?>" class="nav-link ">Division</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('admin/places/add/zone'); ?>" class="nav-link ">Zone</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('admin/places/view/area'); ?>" class="nav-link ">
                            <span class="title">Area</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('admin/places/view/via_place'); ?>" class="nav-link ">
                            <span class="title">Via Places</span>
                        </a>
                    </li>
                    <li class="nav-item  <?php echo $current_view_thana; ?>">
                        <a href="<?php echo site_url('admin/places/view/thana'); ?>" class="nav-link ">
                            <span class="title">Thana</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('admin/places/view/district'); ?>" class="nav-link ">
                            <span class="title">District</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('admin/places/view/division'); ?>" class="nav-link ">
                            <span class="title">Division</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('admin/settings'); ?>" class="nav-link nav-toggle">
                    <i class=" icon-wrench"></i>
                    <span class="title">Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="app_ticket.html" class="nav-link ">
                            <i class="icon-notebook"></i>
                            <span class="title">Support</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="app_ticket.html" class="nav-link ">
                            <i class="icon-notebook"></i>
                            <span class="title">Terms Settings</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('/accounts'); ?>" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Accounts</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('/accounts/deposit'); ?>" class="nav-link ">
                            <i class="icon-user"></i>
                            <span class="title">Deposit</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('/admin/users/all'); ?>" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <i class="icon-user"></i>
                            <span class="title">Profile 1</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->


<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
