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
            <li class="nav-item start active open">
                <a href="<?php echo site_url(); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="index.html" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">Dashboard 1</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('launch'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Launch</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('launch/cabin'); ?>" class="nav-link ">
                            <span class="title">Cabin</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('launch/schedule'); ?>" class="nav-link ">
                            <span class="title">Schedule</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('launch/route'); ?>" class="nav-link ">
                            <span class="title">Route</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('booking/launch'); ?>" class="nav-link ">
                            <span class="title">Booking</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('booking/launch/mycabin'); ?>" class="nav-link ">
                            <span class="title">My Cabin</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('launch/manage_booking'); ?>" class="nav-link ">
                            <span class="title">Manage Booking</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('companies'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Companies</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('companies/register'); ?>" class="nav-link ">
                            <span class="title">Register New</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('counters'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Counters</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('counters/register'); ?>" class="nav-link ">
                            <span class="title">Register New</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="<?php echo site_url('places'); ?>" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Places</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/add_new'); ?>" class="nav-link ">
                            <span class="title">Add New</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item ">
                                <a href="<?php echo site_url('places/add/area'); ?>" class="nav-link ">Area</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('places/add/via_place'); ?>" class="nav-link ">Via Place</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('places/add/thana'); ?>" class="nav-link ">Thana</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('places/add/district'); ?>" class="nav-link ">District</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('places/add/division'); ?>" class="nav-link ">Division</a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo site_url('places/add/zone'); ?>" class="nav-link ">Zone</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/view/area'); ?>" class="nav-link ">
                            <span class="title">Area</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/view/via_place'); ?>" class="nav-link ">
                            <span class="title">Via Places</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/view/thana'); ?>" class="nav-link ">
                            <span class="title">Thana</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/view/district'); ?>" class="nav-link ">
                            <span class="title">District</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/view/division'); ?>" class="nav-link ">
                            <span class="title">Division</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php echo site_url('places/view/zone'); ?>" class="nav-link ">
                            <span class="title">Zone</span>
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
                <a href="<?php echo site_url('/admin/users'); ?>" class="nav-link nav-toggle">
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
