<?php
session_start();
require "conn.php";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '訪客';
$gmail = isset($_SESSION['gmail']) ? $_SESSION['gmail'] : '請先登入';

// $selectSql = "SELECT studentid, username, gmail, mail, phonenum, role FROM students";
// $selectStmt = $conn->prepare($selectSql);
// $selectStmt->execute();
// $selectStmt->bind_result($studentid, $username, $gmail, $mail, $phonenum, $role);

//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';
require_once 'php/functions.php';

$datas = get_publish_article();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description"
          content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">

    <!-- theme meta -->
    <meta name="theme-name" content="sleek"/>

    <title>嘉大資工系教室管理與器材借用系統 | 首頁</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
          rel="stylesheet"/>

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet"/>

    <!-- PLUGINS CSS STYLE -->
    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet"/>
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet"/>

    <!-- No Extra plugin used -->
    <link href='assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css' rel='stylesheet'>
    <link href='assets/plugins/daterangepicker/daterangepicker.css' rel='stylesheet'>
    <link href='assets/plugins/toastr/toastr.min.css' rel='stylesheet'>
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css"/>

    <!-- FAVICON -->
    <link href="assets/img/logo.png" rel="shortcut icon"/>

    <!--
      HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
    -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
<script>
    NProgress.configure({showSpinner: false});
    NProgress.start();
</script>

<div id="toaster"></div>

<!-- ====================================
——— WRAPPER
===================================== -->
<div class="wrapper">
    <!-- ====================================
      ——— LEFT SIDEBAR WITH OUT FOOTER
    ===================================== -->
    <aside class="left-sidebar bg-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand" style="background-color:#B0C4DE">
                <a href="index.php" title="NCYU CSIE Dashboard">

                    <img src="assets/img/newlogo.png" alt="logo" width='60px'>
                    <span class="brand-name text-truncate" style='color:#2a394a; background:#B0C4DE;'>NCYU CSIE</span>
                </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <li class="has-sub ">
                        <!--<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                           data-target="#components"
                           aria-expanded="false" aria-controls="components">
                            <i class="mdi mdi-folder-multiple-outline"></i>
                            <span class="nav-text">一般教室借用</span> <b class="caret"></b>
                        </a>-->

                        <ul class="collapse " id="components" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="401.php">
                                        <span class="nav-text">A16-401</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="402.php">
                                        <span class="nav-text">A16-402</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="403.php">
                                        <span class="nav-text">A16-403</span>

                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="413.php">
                                        <span class="nav-text">A16-413</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="415.php">
                                        <span class="nav-text">A16-415</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="416.php">
                                        <span class="nav-text">A16-416</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>

                    <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                           aria-expanded="false" aria-controls="app">
                            <i class="mdi mdi-pencil-box-multiple"></i>
                            <span class="nav-text">借用登記</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="app" data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="">
                                    <a class="sidenav-item-link" href="classroom.php">
                                        <span class="nav-text">一般教室借用</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="meetingroom.php">
                                        <span class="nav-text">研討室借用</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="item.php">
                                        <span class="nav-text">設備借用</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>


                    <li class="has-sub">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                           data-target="#dashboard"
                           aria-expanded="false" aria-controls="dashboard">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">借用紀錄</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse" id="dashboard" data-parent="#sidebar-menu">
                            <div class="sub-menu">

                                <li class="">
                                    <a class="sidenav-item-link" href="myreserve.php?data=StatusClassroom">
                                        <span class="nav-text">一般教室借用紀錄</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a class="sidenav-item-link" href="myreserve.php?data=StatusMeetingroom">
                                        <span class="nav-text">研討室借用紀錄</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="myreserve.php?data=StatusItem">
                                        <span class="nav-text">設備借用紀錄</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>

                    <!-- <li class="section-title">
                      UI Elements
                    </li> -->


                    <li class="has-sub ">
                        <a class="sidenav-item-link" href="contact.php">
                            <i class="mdi mdi-email-mark-as-unread"></i>
                            <span class="nav-text">聯絡我們</span>
                        </a>


                    </li>
                    <li class="has-sub ">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                           data-target="#authentication"
                           aria-expanded="false" aria-controls="authentication">
                            <span class="nav-text">登入 / 註冊</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse " id="authentication">
                            <div class="sub-menu">
                                <li class="">
                                    <a href="login.php">登入</a>
                                </li>

                                <li class="">
                                    <a href="register.php">註冊</a>
                                </li>
                            </div>
                        </ul>
                    </li>


                    <!-- <li class="section-title">
                      Pages
                    </li> -->


                    <!-- <li class="section-title">
                      Documentation
                    </li> -->
                </ul>
            </div>


        </div>
    </aside>


    <!-- ====================================
  ——— PAGE WRAPPER
  ===================================== -->
    <div class="page-wrapper">


        <!-- Header -->
        <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
                <!-- Sidebar toggle button -->
                <button id="sidebar-toggler" class="sidebar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <!-- search form -->
                <div class="search-form d-none d-lg-inline-block">
                    <div class="input-group">
                        <!--<button type="button" name="search" id="search-btn" class="btn btn-flat">-->
                        <!--<i class="mdi mdi-magnify"></i>-->
                        </button>
                        <!--<input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc."-->
                        <!--  autofocus autocomplete="off" />-->
                    </div>
                    <!--<div id="search-results-container">-->
                    <!--  <ul id="search-results"></ul>-->
                    <!--</div>-->
                </div>

                <div class="navbar-right ">
                    <ul class="nav navbar-nav">
                        <!--<li class="dropdown notifications-menu custom-dropdown">-->
                        <!--  <button class="dropdown-toggle notify-toggler custom-dropdown-toggler">-->
                        <!--    <i class="mdi mdi-bell-outline"></i>-->
                        </button>

                        <!--齒輪-->
                        </li>
                        <li class="right-sidebar-in right-sidebar-2-menu">
                            <i class="mdi mdi-settings mdi-spin"></i>
                        </li>
                        <!-- User Account -->
                        <li class="dropdown user-menu">
                            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                <img src="assets/img/user.png" class="user-image" alt="User Image"/>
                                <span class="d-none d-lg-inline-block"><?php echo $username; ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <!-- User image -->
                                <li class="dropdown-header" style="margin-bottom: 0;">
                                    <img src="assets/img/user.png" class="img-circle" alt="User Image"/>
                                    <div class="d-inline-block">
                                        <?php echo $username; ?> <small class="pt-1"><?php echo $gmail; ?></small>
                                    </div>
                                </li>

                                <!--<li>-->
                                <!--  <a href="myreserve.php">-->
                                <!--    <i class="mdi mdi-account"></i> 我的預約-->
                                <!--  </a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--  <a href=myreserve.php">-->
                                <!--    <i class="mdi mdi-email"></i> 我的預約-->
                                <!--  </a>-->
                                <!--</li>-->

                                <li class="dropdown-footer" style="margin-top: 0;">
                                    <a href="logout.php"> <i class="mdi mdi-logout"></i> 登出</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>


        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->

        <div class="content">
            <div class="card card-default">
                <div class="card-body" class="bordder">
                    <div class="row">
                        <div class="col-12">
                            <h2 style="color:#4d5a80; font-size: 35px;">
                                <center><b>最新公告</center>
                                </b></h2>
                            <br>
                        </div>
                        <div class="main">
                            <div class="container" >
                                <br>
                                <?php if (!empty($datas)): ?>
                                    <?php foreach ($datas as $article): ?>
                                        <?php
                                        $abstract = strip_tags($article['content']);  //摘要
                                        $abstract = mb_substr($abstract, 0, 100, "UTF-8")  //摘要擷取100字
                                        ?>
                                        <div class="card">
                                            <h5 class="card-header"><strong><?php echo $article['title'] ?></strong>
                                            </h5>
                                            <hr>
                                            <div class="card-body">
                                                <p class="card-text"><?php echo $article['create_date'] ?></p>
                                                <br>
                                                <p class="card-text"><?php echo $abstract . "...MORE"; ?></p>
                                                <br>
                                                <a href='article.php?i=<?php echo $article['id']; ?>' class="btn
                                                btn-primary">點我查看</a>

                                                <style>
                                                    .btn-primary {
                                                        background-color: #B0C4DE; /* 更改为您想要的按钮背景颜色 */
                                                        border-color: #B0C4DE; /* 更改为您想要的按钮边框颜色 */
                                                    }
                                                    
                                                    .btn-primary:hover {
                                                        background-color: #6690ad; /* 鼠標移置時的背景顏色 */
                                                        border-color: #6690ad; /* 鼠標移置時的邊框顏色 */
                                                        
                                                    }
                                                </style>

                                            </div>
                                        </div>
                                        <br>
                                    <?php endforeach; ?>

                                <?php endif; ?>
                            </div>
                            <style>
                                .main {
                                    margin-left: auto;
                                    margin-right: auto;
                                }

                            </style>
                        </div>
                    </div>
                </div>
                <!-- Top Statistics -->


            </div> <!-- End Content -->
        </div> <!-- End Content Wrapper -->


        <!-- Footer -->
        <footer class="footer mt-auto">
            <div class="copyright bg-white">
                <p>
                    &copy; <span id="copy-year"></span> a template by D Irene Lulu Mia</a>.
                </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
        </footer>

    </div> <!-- End Page Wrapper -->
</div> <!-- End Wrapper -->


<!-- <script type="module">
  import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

  const el = document.createElement('pwa-update');
  document.body.appendChild(el);
</script> -->

<!-- Javascript -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/simplebar/simplebar.min.js"></script>

<script src='assets/plugins/charts/Chart.min.js'></script>
<script src='assets/js/chart.js'></script>


<script src='assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js'></script>
<script src='assets/plugins/jvectormap/jquery-jvectormap-world-mill.js'></script>
<script src='assets/js/vector-map.js'></script>

<script src='assets/plugins/daterangepicker/moment.min.js'></script>
<script src='assets/plugins/daterangepicker/daterangepicker.js'></script>
<script src='assets/js/date-range.js'></script>


<script src='assets/plugins/toastr/toastr.min.js'></script>


<!--<script src="assets/js/sleek.js"></script>-->
<link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
</body>
</html>

