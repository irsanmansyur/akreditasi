<div id="top-nav" class="skin-3 fixed">
    <div class="brand">
        <img src="<?= base_url('assets') ?>/img/header-profile.png" style="max-height: 30px">
    </div><!-- /brand -->
    <button type="button" class="navbar-toggle size-toggle pull-left">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <button type="button" class="navbar-toggle size-toggle pull-left hide-menu">
        <div class="size-toggle">
            <a class="btn btn-sm" id="sizeToggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </div><!-- /size-toggle -->
    </button>
    <ul class="nav-notification clearfix">
        <!-- <li class="dropdown hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks fa-lg"></i>
                        <span class="notification-label bounceIn animation-delay5">4</span>
                    </a>
                    <ul class="dropdown-menu task dropdown-2">
                        <li><a href="#">You have 4 tasks to complete</a></li>                     
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">Bug Fixes</span>
                                    <small class="pull-right text-muted">78%</small>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width:78%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">Software Updating</span>
                                    <small class="pull-right text-muted">54%</small>
                                </div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" style="width:54%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">Database Migration</span>
                                    <small class="pull-right text-muted">23%</small>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" style="width:23%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="clearfix">
                                    <span class="pull-left">Unit Testing</span>
                                    <small class="pull-right text-muted">92%</small>
                                </div>
                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-danger " style="width:92%"></div>
                                </div>
                            </a>
                        </li>
                        <li><a href="#">View all tasks</a></li>                   
                    </ul>
                </li> -->
        <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-lg"></i>
                        <span class="notification-label bounceIn animation-delay6">5</span>
                    </a>
                    <ul class="dropdown-menu notification dropdown-3">
                        <li><a href="#">You have 5 new notifications</a></li>                     
                        <li>
                            <a href="#">
                                <span class="notification-icon bg-warning">
                                    <i class="fa fa-warning"></i>
                                </span>
                                <span class="m-left-xs">Server #2 not responding.</span>
                                <span class="time text-muted">Just now</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="notification-icon bg-success">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="m-left-xs">New user registration.</span>
                                <span class="time text-muted">2m ago</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="notification-icon bg-danger">
                                    <i class="fa fa-bolt"></i>
                                </span>
                                <span class="m-left-xs">Application error.</span>
                                <span class="time text-muted">5m ago</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="notification-icon bg-success">
                                    <i class="fa fa-usd"></i>
                                </span>
                                <span class="m-left-xs">2 items sold.</span>
                                <span class="time text-muted">1hr ago</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="notification-icon bg-success">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="m-left-xs">New user registration.</span>
                                <span class="time text-muted">1hr ago</span>
                            </a>
                        </li>
                        <li><a href="#">View all notifications</a></li>                   
                    </ul>
                </li> -->
        <li class="profile dropdown">
            <?php if (!empty($this->session->userdata('loginData'))) : ?>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <strong>Admin</strong>
                    <span><i class="fa fa-chevron-down"></i></span>
                </a>
            <?php else : ?>
                <a class="dropdown-toggle" href="<?= base_url('login') ?>">
                    <strong>Login</strong>
                    <span><i class="fa fa-chevron-down"></i></span>
                </a>
            <?php endif ?>
            <ul class="dropdown-menu">
                <li>
                    <a class="clearfix" href="#">
                        <img src="<?= base_url('assets') ?>/img/user.jpg" alt="User Avatar">
                        <div class="detail">
                            <strong>John Doe</strong>
                            <p class="grey">John_Doe@email.com</p>
                        </div>
                    </a>
                </li>
                <!-- <li><a tabindex="-1" href="profile.html" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit profile</a></li>
                        <li><a tabindex="-1" href="gallery.html" class="main-link"><i class="fa fa-picture-o fa-lg"></i> Photo Gallery</a></li>
                        <li><a tabindex="-1" href="#" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Setting</a></li> -->
                <br><br>
                <li class="divider"></li>
                <li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
            </ul>
        </li>
    </ul>
</div><!-- /top-nav-->