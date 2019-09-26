<!doctype html>
<html lang="en">
<?php

error_reporting(E_ALL & ~E_NOTICE);

?>
<head>

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="<?= base_url("main.css"); ?>" rel="stylesheet">
    <link href="<?= base_url("css/custom.css"); ?>" rel="stylesheet">
    <script src="<?= base_url("js/dc.js") ?>"></script>

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css" />
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <!-- Data table -->



    <!-- Date pickadate Style -->
    <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.css" id="theme_base">
    <link rel="stylesheet" href="https://common.olemiss.edu/_js/pickadate.js-3.5.3/lib/themes/classic.date.css" id="theme_date">
    <!-- Date pickadate Style -->



    <style>
        * {
            font-family: 'Sarabun', sans-serif;
        }

        body {
            font-size: .85rem !important;
        }

        .status_color {
            color: green;
        }
    </style>


    <?php
    $getuser = $this->login_model->getuser();
    $getuserCon = $this->doc_get_model->convertName($getuser->Fname, $getuser->Lname);
    get_modal();
    ?>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">




        <!-- Topbar -->
        <div class="app-header header-shadow">

            <!-- Logo section -->
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Logo section -->


            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>


            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>


            <!-- Header content -->
            <div class="app-header__content">

                <!-- Topmenu left -->
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <!-- <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-database"> </i>
                                Statistics
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Projects
                            </a>
                        </li>
                        <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul> -->
                </div>
                <!-- Topmenu left -->

                <!-- Top menu right -->
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <?php 
                                $username = $_SESSION['username'];
                                $result = get_group($username);
                                $getdatarow = $result->row();

                                $deptcode = get_deptcode_new($username)->dc_user_new_dept_code;
                                ?>

                                <!-- Check Section -->
                                <input hidden type="text" name="check_group" id="check_group" value="<?=$getdatarow->dc_gp_permis_name?>" />
                                <input hidden type="text" name="check_username" id="check_username" value="<?= $getuserCon?>">
                                <input hidden type="text" name="check_new_deptcode" id="check_new_deptcode" value="<?=$deptcode?>">
                                <!-- Check Section -->
                                
                            </div>


                                <!-- <div class="widget-content-left">
                                    <div class="btn-group">
                                        
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?= $getuserCon; ?>
                                        <input hidden type="text" name="check_userlogin" id="check_userlogin" value="<?= $getuserCon; ?>">
                                        <!-- Check user permission for btn_edit -->
                                    </div>
                                    <div class="widget-subheading">
                                        <?= $getuser->ecode; ?> - <?= $getuser->DeptCode; ?>
                                    </div>
                                </div>

                                <div class="widget-content-right header-user-info ml-3">
                                    <a href="<?= base_url('login/logout'); ?>"><button type="button" class="btn-shadow p-1 btn btn-primary btn-sm" onclick="javascript:return confirm('คุณต้องการออกจากระบบใช่หรือไม่')">
                                            <i class="fas fa-sign-out-alt pr-1 pl-1" style="font-size:16px;"></i>
                                        </button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top menu right -->


            </div>
            <!-- Header content -->
        </div>
        <!-- Topbar -->




        <div class="app-main">


            <!-- Slide Nav bar left -->
            <div class="app-sidebar sidebar-shadow">

                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>

                <!-- Left Menu -->
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">


                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="<?= base_url(); ?>" class="">
                                    <!-- <i class="metismenu-icon pe-7s-rocket"></i> -->
                                    <i class="metismenu-icon fas fa-chart-line"></i>
                                    Dashboard
                                </a>
                            </li>



                            <?php
                            if ($this->uri->segment(2) == "view_by_dept" || $this->uri->segment(2) == "view_document" || $this->uri->segment(2) == "viewFull_document") {
                                $li_search = ' mm-active ';
                                $search_dept = 'mm-active';
                                $search_center = '';
                                $search_me = '';
                            } else if ($this->uri->segment(2) == "document_center" || $this->uri->segment(2) == "viewfull_gl_document" || $this->uri->segment(2) == "view_gl_document") {
                                $search_center = 'mm-active';
                                $li_search = ' mm-active ';
                                $search_me = '';
                                $search_dept = '';
                            } else if ($this->uri->segment(2) == "document_me") {
                                $search_center = '';
                                $li_search = ' mm-active ';
                                $search_me = '';
                                $search_dept = '';
                                $search_me = 'mm-active';
                            } else {
                                $search_center = '';
                                $li_search = '';
                                $search_me = '';
                                $search_dept = '';
                                $search_me = '';
                            }
                            ?>
                            <li class="app-sidebar__heading"></i>Document</li>
                            <li class="<?= $li_search ?>">
                                <a href="#">
                                    <i class="metismenu-icon fas fa-archive"></i>
                                    ค้นหาเอกสาร
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?= base_url('librarys') ?>" class="<?= $search_dept ?>">
                                            <i class="metismenu-icon"></i>
                                            ตู้เอกสาร ISO
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('librarys/document_center') ?>" class="<?= $search_center ?>">
                                            <i class="metismenu-icon"></i>
                                            ตู้เอกสาร ทั่วไป
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="#" class="<?= $search_me ?>">
                                            <i class="metismenu-icon"></i>
                                            ตู้เอกสารของฉัน
                                        </a>
                                    </li> -->

                                </ul>
                            </li>


                            <?php
                            if ($this->uri->segment(2) == "list_dar" || $this->uri->segment(2) == "viewfull") {
                                $doc_list = ' mm-active';
                                $doc_list_iso = 'mm-active';
                                $doc_list_gl = '';
                            } else if ($this->uri->segment(2) == "list_generel" || $this->uri->segment(2) == "gl_view_doc") {
                                $doc_list = ' mm-active';
                                $doc_list_iso = '';
                                $doc_list_gl = 'mm-active';
                            } else {
                                $doc_list = '';
                                $doc_list_iso = '';
                                $doc_list_gl = '';
                            }
                            ?>
                            <li class="<?= $doc_list ?>">
                                <a href="#">
                                    <i class="metismenu-icon fas fa-folder"></i>
                                    รายการคำร้อง&nbsp;<span class="badge badge-pill badge-success"><?=count_darfile()?></span>
                                <span class="badge badge-pill badge-warning"><?=count_glfile()?></span>
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a class="navleft <?= $doc_list_iso ?>" href="<?= base_url("document/list_dar") ?>">
                                            <i class="metismenu-icon">
                                            </i><span class="badge badge-pill badge-success"><?=count_darfile()?></span>&nbsp;&nbsp;รายการคำร้องเอกสาร ISO
                                        </a>
                                    </li>
                                    <li>
                                        <a class="navleft <?= $doc_list_gl ?>" href="<?= base_url("document/list_generel"); ?>">
                                            <i class="metismenu-icon">
                                            </i><span class="badge badge-pill badge-warning"><?=count_glfile()?></span>&nbsp;&nbsp;รายการคำร้องเอกสารทั่วไป
                                        </a>
                                    </li>

                                </ul>
                            </li>



                            <!-- MENU -->
                            <?php
                            if ($this->uri->segment(2) == "add_dar") {
                                $add_doc = 'mm-active';
                                $add_iso = 'mm-active';
                                $add_gl = '';
                            } else if ($this->uri->segment(2) == "add_gl_doc") {
                                $add_doc = 'mm-active';
                                $add_gl = 'mm-active';
                                $add_iso = '';
                            } else {
                                $add_doc = '';
                                $add_gl = '';
                                $add_iso = '';
                            }
                            ?>
                            <li class="<?= $add_doc ?>">
                                <a href="#">
                                    <i class="metismenu-icon fas fa-folder-plus"></i>
                                    เพิ่มคำร้อง
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a class="navleft <?= $add_iso ?>" href="<?= base_url("document/add_dar"); ?>">
                                            <i class="metismenu-icon">
                                            </i>เพิ่มคำร้องเอกสาร ISO
                                        </a>
                                    </li>
                                    <li>
                                        <a class="navleft <?= $add_gl ?>" href="<?= base_url('document/add_gl_doc') ?>">
                                            <i class="metismenu-icon">
                                            </i>เพิ่มคำร้องเอกสาร ทั่วไป
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <!-- MENU -->


                            <?php
                            if ($this->uri->segment(2) == "") {
                                $isolist = 'mm-active';
                               
                            }else if($this->uri->segment(2) == "manage_dept"){
                                $foradmin = 'mm-active';
                                $manage_dept = 'mm-active';
                                $isolist = '';
                            } else if($this->uri->segment(2) == "view_user"){
                                $foradmin = 'mm-active';
                                $view_user = 'mm-active';
                                $manage_dept = '';
                                
                            }
                            ?>
                            <li id="admin_section"class="app-sidebar__heading"></i>For Admin</li>
                            <li id="admin_section" class="<?=$foradmin?>">
                                <a href="#">
                                    <i class="metismenu-icon fas fa-user-shield"></i>
                                    สำหรับผู้ดูแลระบบ
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a class="navleft <?=$manage_dept?>" href="<?= base_url('staff/manage_dept') ?>">
                                            <i class="metismenu-icon"></i>
                                            จัดการตู้เอกสารทั่วไป
                                        </a>
                                    </li>
                                    <li>
                                        <hr>
                                    </li>
                                    <li>
                                        <a class="navleft <?= $view_user ?>" href="<?= base_url('staff/view_user') ?>">
                                            <i class="metismenu-icon"></i>
                                            จัดการผู้ใช้งาน
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li id="admin_section" class="<?= $isolist ?>">
                                <a href="#">
                                    <i class="metismenu-icon fas fa-folder"></i>
                                    รายการเอกสาร
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?= base_url('staff') ?>" class="<?= $isolist ?>">
                                            <i class="metismenu-icon"></i>
                                            ตู้เอกสาร ISO
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="<?= base_url('staff/gl/') ?>" class="">
                                            <i class="metismenu-icon"></i>
                                            ตู้เอกสาร ทั่วไป
                                        </a>
                                    </li> -->
                                </ul>
                            </li>

                            <!-- <li id="admin_section">
                                <a href="#">
                                    <i class="metismenu-icon fas fa-cogs"></i>
                                    ตั้งค่า
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?= base_url('librarys/index') ?>">
                                            <i class="metismenu-icon"></i>
                                            สิทธิ์การใช้งานของ User
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="metismenu-icon"></i>
                                            สิทธิ์การใช้งานของ ตู้เอกสาร
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="metismenu-icon"></i>
                                            ตั้งค่าผู้ใช้งาน
                                        </a>
                                    </li>
                                </ul>
                            </li> -->



                        </ul>


                    </div>
                </div>
                <!-- Left Menu -->

            </div>
            <!-- Slide Nav bar left -->