<?php

use app\components\Session;
use app\models\User;

 ?>


<div class="navbar-custom bg-primary">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <?php /*
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="font-16 text-white m-0">
                            <span class="float-right">
                                <a href="" class="text-white">
                                    <small>Clear All</small>
                                </a>
                            </span>Notification
                        </h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success">
                                <i class="mdi mdi-settings-outline"></i>
                            </div>
                            <p class="notify-details">New settings
                                <small class="text-muted">There are new settings available</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-bell-outline"></i>
                            </div>
                            <p class="notify-details">Updates
                                <small class="text-muted">There are 2 new updates available</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <p class="notify-details">New user
                                <small class="text-muted">You have 10 unread messages</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">4 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">Carlos Crouch liked
                                <b>Admin</b>
                                <small class="text-muted">13 days ago</small>
                            </p>
                        </a>
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-primary notify-item notify-all">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-email-outline noti-icon"></i>
                    <span class="noti-icon-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="font-16 text-white m-0">
                            <span class="float-right">
                                <a href="" class="text-white">
                                    <small>Clear All</small>
                                </a>
                            </span>Messages
                        </h5>
                    </div>
                    <div class="slimscroll noti-scroll">
                        <div class="inbox-widget">
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Chadengle</p>
                                    <p class="inbox-item-text text-truncate">Hey! there I'm available...</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Tomaslau</p>
                                    <p class="inbox-item-text text-truncate">I've finished it! See you so...</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Stillnotdavid</p>
                                    <p class="inbox-item-text text-truncate">This theme is awesome!</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Kurafire</p>
                                    <p class="inbox-item-text text-truncate">Nice to meet you</p>
                                </div>
                            </a>
                            <a href="#">
                                <div class="inbox-item">
                                    <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                                    <p class="inbox-item-author">Shahedk</p>
                                    <p class="inbox-item-text text-truncate">Hey! there I'm available...</p>

                                </div>
                            </a>
                        </div> <!-- end inbox-widget -->
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-primary notify-item notify-all">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>
            */ ?>
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <?php 
                    $user = User::findOne(['id' => Session::getIdUser()]);
                    $urlImage = $user->getLinkImage();
                ?>
                <img src="<?= $urlImage ?>" alt="user-image" class="rounded-circle" style="width:2rem; height:2rem; object-fit: cover;">
                <span class="d-none d-sm-inline-block ml-1 font-weight-medium"><?= Session::getUsername() ?></span>
                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow text-white m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="<?= \yii\helpers\Url::to(['/user/view/', 'id' => Session::getIdUser()]) ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-outline"></i>
                    <span>Profile</span>
                </a>

                <?php /*
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-settings-outline"></i>
                    <span>Settings</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline"></i>
                    <span>Lock Screen</span>
                </a>
                */ ?>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" data-method="post" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout-variant"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="javascript:void(0)" onclick="location.reload()" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="<?= Yii::getAlias('@web').'/images/logo3.jpeg' ?>" alt="" height="24" style="width: 100%; object-fit: contain; transform: scale(2.5);">
                            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="<?= Yii::getAlias('@web').'/images/logo3.jpeg' ?>" alt="" height="24" style="width: 100%; object-fit: contain; transform: scale(2.5);">
                        </span>
        </a>

        <a href="javascript:void(0)" onclick="location.reload()" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="<?= Yii::getAlias('@web').'/images/logo2.png' ?>" alt="" height="">
                            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="<?= Yii::getAlias('@web').'/images/logo2-sm.png' ?>" alt="" height="">
                        </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0 d-flex" style="display: flex; justify-content: center; text-align: center; align-items: center;">
        <li class="list-item">
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="mdi mdi-menu text-white"></i>
            </button>
        </li>
        <li class="list-item" style="flex-grow: 1;">
            <div class="container">
                <img src="<?= Yii::getAlias('@web').'/images/logo3-text.jpeg' ?>" alt="user-image" style="height: 56px; border-radius: 8px" class="topnav-logo">
                <img src="<?= Yii::getAlias('@web').'/images/logo3.jpeg' ?>" alt="user-image" style="height: 56px; border-radius: 8px;" class="topnav-logo-small">
            </div>
        </li>
        <?php /*
        <li class="d-none d-sm-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <div class="input-group-append">
                            <button class="btn" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </li>
        */ ?>
    </ul>
</div>


<style>
    /* Default styling for smaller screens */
.topnav-logo {
    max-height: 40px;
    border-radius: 8px;
}

.topnav-logo-small {
    display: none;
    margin-left: auto;
    margin-right: auto;
    max-height: 40px;
}

/* Small devices (landscape phones, 576px and up) */
@media (max-width: 576px) {
    .topnav-logo {
        /* max-height: 48px; */
        display: none;
    }
    .topnav-logo-small {
        /* max-height: 48px; */
        display: block;
    }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) {
    .topnav-logo {
        max-height: 56px;
    }
    .topnav-logo-small {
        display: none;
    }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .topnav-logo {
        max-height: 64px;
    }
    .topnav-logo-small {
        display: none;
    }
}

/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {
    .topnav-logo {
        max-height: 72px;
    }
    .topnav-logo-small {
        display: none;
    }
}

</style>