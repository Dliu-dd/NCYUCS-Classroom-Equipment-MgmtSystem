<?php
session_start();
require "conn.php";
// $username = isset($_SESSION['username']) ? $_SESSION['username'] : '訪客';
$gmail = isset($_SESSION['gmail']) ? $_SESSION['gmail'] : '請先登入';
$studentid = $_SESSION['studentid'];
$username = $_SESSION['username'];


//載入 db.php 檔案，讓我們可以透過它連接資料庫
require_once 'php/db.php';
require_once 'php/functions.php';

$datas = get_all_article();
//print_r($datas);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description"
          content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">

    <!-- theme meta -->
    <meta name="theme-name" content="sleek"/>

    <title>嘉大資工系教室管理與器材借用系統 | 管理者頁面</title>

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

    function active(e) {
        var item = document.querySelector("#" + e);
        item.classList.add("active");
    }
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
                <a title="NCYU CSIE Dashboard">
                    <!--<svg-->
                    <!--  class="brand-icon"-->
                    <!--  xmlns="http://www.w3.org/2000/svg"-->
                    <!--  preserveAspectRatio="xMidYMid"-->
                    <!--  width="30"-->
                    <!--  height="33"-->
                    <!--  viewBox="0 0 30 33">-->
                    <!--  <g fill="none" fill-rule="evenodd">-->
                    <!--    <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />-->
                    <!--    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />-->
                    <!--  </g>-->
                    <!--</svg>-->
                    <img src="assets/img/newlogo.png" alt="logo" width='60px'>
                    <span class="brand-name text-truncate" style='color:#2a394a; background:#B0C4DE;'>NCYU CSIE</span>
                </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">

                    <li class="has-sub" id="Article">
                        <a class="sidenav-item-link" href="admin.php?data=article">
                            <i class="mdi mdi-pencil-box-multiple"></i>
                            <span class="nav-text">最新公告</span>
                        </a></li>

                    <li class="has-sub" id="Info">
                        <a class="sidenav-item-link" href="admin.php?data=UserData">
                            <i class="mdi mdi-folder-multiple-outline"></i><!--圖示-->
                            <span class="nav-text">使用者資料</span>
                        </a>

                    </li>

                    <!--<li class="has-sub">-->
                    <!--  <a class="sidenav-item-link" href="admin.php?data=StatusClassroom">-->
                    <!--    <i class="mdi mdi-pencil-box-multiple"></i>-->
                    <!--    <span class="nav-text">一般教室借用紀錄</span>-->
                    <!--  </a></li>-->


                    <!--<li class="has-sub">-->
                    <!--  <a class="sidenav-item-link" href="admin.php?data=StatusMeetingroom">-->
                    <!--    <i class="mdi mdi-view-dashboard-outline"></i>-->
                    <!--    <span class="nav-text">研討室借用紀錄</span>-->
                    <!--  </a>-->
                    <!--</li>-->

                    <!--<li class="has-sub ">-->
                    <!--  <a class="sidenav-item-link" href="admin.php?data=StatusItem">-->
                    <!--    <i class="mdi mdi-email-mark-as-unread"></i>-->
                    <!--    <span class="nav-text">設備借用紀錄</span>-->
                    <!--  </a>-->
                    <!--</li>  -->

                    <li class="has-sub" id="Borrow">
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                           data-target="#dashboard"
                           aria-expanded="false" aria-controls="dashboard">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span class="nav-text">使用者借用狀況</span> <b class="caret"></b>
                        </a>

                        <ul class="collapse" id="dashboard" data-parent="#sidebar-menu">
                            <div class="sub-menu">

                                <li class="">
                                    <a class="sidenav-item-link" href="admin.php?data=StatusClassroom">
                                        <span class="nav-text">一般教室借用紀錄</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a class="sidenav-item-link" href="admin.php?data=StatusMeetingroom">
                                        <span class="nav-text">研討室借用紀錄</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a class="sidenav-item-link" href="admin.php?data=StatusItem">
                                        <span class="nav-text">設備借用紀錄</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>

                    <!-- <li class="section-title">
                      UI Elements
                    </li> -->


                    <!--<li class="has-sub ">-->
                    <!--   <a class="sidenav-item-link" href="">-->
                    <!--     <i class="mdi mdi-email-mark-as-unread"></i>-->
                    <!--     <span class="nav-text">黑名單</span>-->
                    <!--   </a>-->
                    <!-- </li>-->

                    <ul class="collapse " id="forms" data-parent="#sidebar-menu">

                    </ul>
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
                                <!--  <a href="admin.php?data=">-->
                                <!--    <i class="mdi mdi-account"></i> 管理者資料-->
                                <!--  </a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--  <a href=myreserve.php">-->
                                <!--    <i class="mdi mdi-email"></i> 我的預約-->
                                <!--  </a>-->
                                <!--</li>-->

                                <li class="dropdown-footer" style="margin-top: 0;">
                                    <a href="logout.php"> <i class="mdi mdi-logout"></i> 登出 </a>
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
        <div class="content-wrapper">
            <div class="content">
                <style>
                    /* 基本表格樣式 */
                    table {
                        border-collapse: collapse;
                        width: 80%;
                        border-collapse: collapse;
                        text-align: center;
                        margin-left: 100px;
                        margin-top: 30px;
                        margin-bottom: 30px;
                        overflow: hidden; /* 隱藏多出的邊角 */
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加陰影效果 */

                    }

                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: center;
                    }

                    th {
                        background-color: #f2f2f2;
                    }

                    /* 滑鼠懸停時的效果 */
                    tr:hover {
                        background-color: #f5f5f5;
                    }

                    .gray-button {
                        color: #888; /* 設置文字顏色為灰色 */
                        text-decoration: none; /* 刪除默認的下劃線 */
                        background-color: #f0f0f0; /* 將背景顏色設置為淺灰色 */
                        padding: 5px 10px; /* 添加內邊距以獲得更好的視覺效果 */
                        border-radius: 5px; /* 選擇性：添加圓角 */
                        display: inline-block; /* 將其設置為塊元素，以允許設置寬度和高度 */
                    }


                </style>

                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>
                            <?php
		                    if(isset($_GET['data']) && $_GET['data'] === 'article'){
		                    echo "<b><font color='#394d84' size='5'>
                            <center>管理最新公告</center>
                        </font></b>";
                            }
                            if(isset($_GET['data']) && $_GET['data'] === 'UserData'){
                            echo "<b><font color='#394d84' size='5'>
                            <center>使用者資料</center>
                        </font></b>";
                            }
                            elseif(isset($_GET['data']) && $_GET['data'] === 'StatusClassroom'){
                            echo "<b><font color='#394d84' size='5'>
                            <center>一般教室借用紀錄</center>
                        </font></b>";
                            }
                            elseif(isset($_GET['data']) && $_GET['data'] === 'StatusMeetingroom'){
                            echo "<b><font color='#394d84' size='5'>
                            <center>研討室借用紀錄</center>
                        </font></b>";
                            }
                            elseif(isset($_GET['data']) && $_GET['data'] === 'StatusItem'){
                            echo "<b><font color='#394d84' size='5'>
                            <center>設備借用紀錄</center>
                        </font></b>";
                            }
                            ?>
                        </h2>
                    </div>

                    <div class="card-body">
                        <div class="row">
                        <?php
                        // 管理員才可以看
                        if($studentid === '04Dm!N' && $username === '管理員'){
                        //最新公告
                        if(isset($_GET['data']) && $_GET['data'] === 'article'){
                        ?>
                        <script>active('Article')</script>
                            <?php
                            echo '<div class="main">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="article_add.php" class="btn btn-primary"
                                           style="background-color: #B0C4DE; border-color: #B0C4DE; color: #fff; text-decoration: none; padding: 10px 20px; display: inline-block;">新增公告</a>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <table class="table table-hover" style="margin-left:140px">
                                            <tr style="background-color:#3C3C3C; color:#5B5B5B">
                                                <th>標題</th>
                                                <th>是否發布</th>
                                                <th>建立時間</th>
                                                <th>管理動作</th>
                                            </tr>
                                            ';

                                            if(!empty($datas)) {
                                            foreach($datas as $a_data) {
                                            echo '
                                            <tr style="background-color:#ffffff; color:#000">
                                                <td>'.$a_data['title'].'</td>
                                                <td>'.($a_data['publish'] ? "發布中" : "下架中").'</td>
                                                <td>'.$a_data['create_date'].'</td>
                                                <td>
                                                    <a href="article_edit.php?i='.$a_data['id'].'"
                                                       class="btn btn-success">編輯</a>
                                                    <a href="javascript:void(0);" class="btn btn-danger del_article"
                                                       data-id="'.$a_data['id'].'">刪除</a>
                                                </td>
                                            </tr>
                                            ';
                                            }
                                            } else {
                                            echo '
                                            <tr>
                                                <td colspan="4">無資料</td>
                                            </tr>
                                            ';
                                            }

                                            echo '
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                        }

                        //使用者資料
                        if(isset($_GET['data']) && $_GET['data'] === 'UserData'){
                        ?>
                        <script>active('Info')</script>
                        <?php
                        echo "<table>
                        <tr>
                            <th>學號</th>
                            <th>名字</th>
                            <th>學校信箱</th>
                            <th>私人信箱</th>
                            <th>電話</th>
                            <th>類型</th>
                        </tr>
                        ";
                        // 使用 prepared statement 查詢資料
                        $selectSql = "SELECT studentid, username, gmail, mail, phonenum, role FROM students";
                        $selectStmt = $conn->prepare($selectSql);
                        $selectStmt->execute();
                        $selectStmt->bind_result($studentid, $username, $gmail, $mail, $phonenum, $role);

                        // 顯示資料
                        while ($selectStmt->fetch()) {
                        echo "
                        <tr>";
                            echo "
                            <td>$studentid</td>
                            ";
                            echo "
                            <td>$username</td>
                            ";
                            echo "
                            <td>$gmail</td>
                            ";
                            echo "
                            <td>$mail</td>
                            ";
                            echo "
                            <td>$phonenum</td>
                            ";
                            echo "
                            <td>$role</td>
                            ";
                            echo "
                        </tr>
                        ";
                        }

                        $selectStmt->close();
                        echo "</table>";
                        }
                        //使用者借用狀況-一般教室
                        if(isset($_GET['data']) && $_GET['data'] === 'StatusClassroom'){
                        ?>
                        <script>active('Borrow')</script>
                        <?php
                        echo "<table>
                        <tr>
                            <th>學號</th>
                            <th>名字</th>
                            <th>借用教室</th>
                            <th>借用物品</th>
                            <th>借用日期</th>
                            <th>借用時間</th>
                            <th>功能</th>
                        </tr>
                        ";

                        // 使用 prepared statement 查詢資料
                        $selectSql = "SELECT id, studentid, username, classroom, item, BorrowDay, start, end FROM
                        reserved_classroom ORDER BY BorrowDay ASC";
                        $selectStmt = $conn->prepare($selectSql);
                        $selectStmt->execute();
                        $selectStmt->bind_result($id, $studentid, $username, $classroom, $item, $BorrowDay, $start,
                        $end);

                        // 顯示資料
                        while ($selectStmt->fetch()) {
                        echo "
                        <tr>";
                            echo "
                            <td>$studentid</td>
                            ";
                            echo "
                            <td>$username</td>
                            ";
                            echo "
                            <td>$classroom</td>
                            ";
                            echo "
                            <td>$item</td>
                            ";
                            echo "
                            <td>$BorrowDay</td>
                            ";
                            echo "
                            <td>從 第 $start 節 到 第 $end 節</td>
                            ";
                            echo '
                            <td><a class="gray-button" href="delete.php?id=' . $id . '">已歸還</a></td>
                            ';
                            echo "
                        </tr>
                        ";
                        }

                        $selectStmt->close();

                        echo "</table>";

                        }

                        //使用者借用狀況-研討室
                        if(isset($_GET['data']) && $_GET['data'] === 'StatusMeetingroom'){
                        ?>
                        <script>active('Borrow')</script>
                        <?php
                        echo "
                        <table>
                        <tr>
                            <th>學號</th>
                            <th>名字</th>
                            <th>借用研討室</th>
                            <th>指導教師</th>
                            <th>借用物品</th>
                            <th>借用日期</th>
                            <th>借用時間</th>
                            <th>功能</th>
                        </tr>
                        ";

                        // 使用 prepared statement 查詢資料
                        $selectSql = "SELECT id, studentid, username, meetingroom, teacher, item, BorrowDay, start, end
                        FROM reserved_meetingroom ORDER BY BorrowDay ASC";
                        $selectStmt = $conn->prepare($selectSql);
                        $selectStmt->execute();
                        $selectStmt->bind_result($id, $studentid, $username, $meetingroom, $teacher, $item, $BorrowDay,
                        $start, $end);

                        // 顯示資料
                        while ($selectStmt->fetch()) {
                        echo "
                        <tr>";
                            echo "
                            <td>$studentid</td>
                            ";
                            echo "
                            <td>$username</td>
                            ";
                            echo "
                            <td>$meetingroom</td>
                            ";
                            echo "
                            <td>$teacher</td>
                            ";
                            echo "
                            <td>$item</td>
                            ";
                            echo "
                            <td>$BorrowDay</td>
                            ";
                            echo "
                            <td>從 第 $start 節 到 第 $end 節</td>
                            ";
                            echo '
                            <td><a class="gray-button" href="delete.php?id=' . $id . '">已歸還</a></td>
                            ';
                            echo "
                        </tr>
                        ";
                        }

                        $selectStmt->close();
                        echo "</table>";
                        }

                        // 使用者借用狀況-設備
                        if(isset($_GET['data']) && $_GET['data'] === 'StatusItem'){
                        ?>
                        <script>active('Borrow')</script>
                        <?php
                        echo "
                        <table>
                        <tr>
                            <th>學號</th>
                            <th>名字</th>
                            <th>借用廠牌</th>
                            <th>借用物品</th>
                            <th>借用日期</th>
                            <th>借用時間</th>
                            <th>功能</th>
                        </tr>
                        ";
                        // 使用 prepared statement 查詢資料
                        $selectSql = "SELECT id, studentid, username, brand, item, BorrowDay, BorrowTime FROM
                        reserved_item ORDER BY BorrowDay,BorrowTime ASC";
                        $selectStmt = $conn->prepare($selectSql);
                        $selectStmt->execute();
                        $selectStmt->bind_result($id, $studentid, $username, $brand, $item, $BorrowDay, $BorrowTime);

                        // 顯示資料
                        while ($selectStmt->fetch()) {
                        echo "
                        <tr>";
                            echo "
                            <td>$studentid</td>
                            ";
                            echo "
                            <td>$username</td>
                            ";
                            echo "
                            <td>$brand</td>
                            ";
                            echo "
                            <td>$item</td>
                            ";
                            echo "
                            <td>$BorrowDay</td>
                            ";
                            echo "
                            <td>$BorrowTime</td>
                            ";
                            echo '
                            <td><a class="gray-button" href="delete.php?id=' . $id . '">已歸還</a></td>
                            ';
                            echo "
                        </tr>
                        ";
                        }

                        $selectStmt->close();
                        echo "</table>";
                        }
                        }
                        else{
                        echo '
                        <script>alert("你不是管理員 >:(");
                        ';
                        echo
                        "window.location.href='login.php';</script>
                        ";
                        exit();
                        }
                        ?>


                    </div>
                </div>
            </div>
            <style>
                /* 基本表格樣式 */
                table {
                    border-collapse: collapse;
                    width: 80%;
                    border-collapse: collapse;
                    text-align: center;
                    margin-left: 100px;
                    margin-top: 30px;
                    margin-bottom: 30px;
                    overflow: hidden; /* 隱藏多出的邊角 */
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 添加陰影效果 */

                }

                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: center;
                }

                th {
                    background-color: #f2f2f2;
                }

                /* 滑鼠懸停時的效果 */
                tr:hover {
                    background-color: #f5f5f5;
                }

                .gray-button {
                    color: #888; /* 設置文字顏色為灰色 */
                    text-decoration: none; /* 刪除默認的下劃線 */
                    background-color: #f0f0f0; /* 將背景顏色設置為淺灰色 */
                    padding: 5px 10px; /* 添加內邊距以獲得更好的視覺效果 */
                    border-radius: 5px; /* 選擇性：添加圓角 */
                    display: inline-block; /* 將其設置為塊元素，以允許設置寬度和高度 */
                }
            </style>
            <!-- Top Statistics -->
        </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->


    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="copyright bg-white">
            <p>
                Copyright &copy; <span id="copy-year"></span> a template by D Irene Lulu Mia</a>.
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


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    $(document).on("ready", function () {
        $("a.del_article").on("click", function () {
            var c = confirm("你確定要刪除嗎?");
            this_tr = $(this).parent().parent();

            if (c) {
                $.ajax({
                    type: "POST",
                    url: "php/del_article.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
                    data: {
                        'id': $(this).attr("data-id")
                    },
                    dataType: 'html' //設定該網頁回應的會是 html 格式
                }).done(function (data) {
                    //成功的時候
                    if (data) {
                        alert("刪除成功，點擊確認移除資料");
                        this_tr.fadeOut();
                    } else {
                        alert("刪除失敗" + data);
                    }

                }).fail(function (jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
            }
        });
    });
</script>
</body>
</html>

