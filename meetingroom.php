<?php
session_start();
require "conn.php";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$gmail = isset($_SESSION['gmail']) ? $_SESSION['gmail'] : '請先登入';
$selectSql = "SELECT studentid, username, gmail, mail, phonenum, role FROM students";
$selectStmt = $conn->prepare($selectSql);
$selectStmt->execute();
$selectStmt->bind_result($studentid, $username, $gmail, $mail, $phonenum, $role);
$selectStmt->close();

?>

<?php

// 登入後才可以用借用系統
if(isset($_SESSION['studentid']) && isset($_SESSION['username'])){
    $studentid = $_SESSION['studentid'];
    $username = $_SESSION['username'];
    if (isset($_POST['meetingroom']) && isset($_POST['BorrowDay']) && isset($_POST['section_start']) && isset($_POST['section_end'])) {
        // 借用研討室
        $meetingroom = $_POST['meetingroom'];
        $_SESSION['meetingroom'] = $meetingroom;
        // 借用物品
        $items = isset($_POST['item']) ? (array)$_POST['item'] : array();
        $item_str = implode(", ", $items);
        // 指導老師
        $teacher = $_POST['teacher'];
        $_SESSION['teacher'] = $teacher;
        // 借用日期
        $currentDate = date("Y-m-d");
        $BorrowDay = $_POST['BorrowDay'];
        $_SESSION['BorrowDay'] = $BorrowDay;
        // 從第幾節開始
        $start = $_POST['section_start'];
        $_SESSION['section_start'] = $start;
        // 從第幾節結束
        $end = $_POST['section_end'];
        $_SESSION['section_end'] = $end;

        // 有沒有和其他人時間撞到
        $sql = "SELECT `meetingroom`, `BorrowDay`, `start`, `end` FROM `reserved_meetingroom`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($meetingroom_check_result, $BorrowDay_check_result, $start_check_result, $end_check_result);

        while ($stmt->fetch()) {
            // 檢查新的預約是否和已有預約衝突
            if (
                $meetingroom === $meetingroom_check_result &&
                $BorrowDay === $BorrowDay_check_result &&
                (
                    ($start >= $start_check_result && $start <= $end_check_result) ||
                    ($end >= $start_check_result && $end <= $end_check_result) ||
                    ($start <= $start_check_result && $end >= $end_check_result)
                )
            ) {
                echo "<script>alert('別人已預約');";
                echo "window.location.href='meetingroom.php';</script>";
                exit();
            }
        }
        $stmt->close();


        // 做節數開始和結束的判斷，開始必大於等於結束
        if($start > $end){
            echo "<script>alert('節數格式錯誤，請重新輸入\\n\\n溫馨提醒：借用的開始結數要小於結束節數');";
            echo "window.location.href='meetingroom.php';</script>";
        }
        // 做借用日期的判斷
        elseif($BorrowDay < $currentDate){
            echo "<script>alert('借用日期格式錯誤，請重新輸入\\n\\n溫馨提醒：借用日期不能早於今日');";
            echo "window.location.href='meetingroom.php';</script>";
        }
        else{

            function getNextBorrowNumber($conn, $studentid) {
                $maxBorrowNumber = 0;
                $sql = "SELECT MAX(SUBSTRING_INDEX(id, '-', -1)) FROM reserved_meetingroom WHERE studentid = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $studentid);
                $stmt->execute();
                $stmt->bind_result($maxBorrowNumber);
                $stmt->fetch();
                $stmt->close();
        
                return ($maxBorrowNumber === null) ? 1 : (int)$maxBorrowNumber + 1;
            }

            // 取得下一個借用編號
            $nextBorrowNumber = getNextBorrowNumber($conn, $studentid);

            // 生成借用編號
            $borrowId = $studentid . "-m-" . $nextBorrowNumber;
            
            // 在設置cookie時，特別添加 HttpOnly的屬性，以防止 XSS 攻擊        
            setcookie("borrowId", $borrowId, 0, "/", "", false, true);
            setcookie("username", $username, 0, "/", "", false, true);
            setcookie("studentid", $studentid, 0, "/", "", false, true);
            setcookie("teacher", $teacher, 0, "/", "", false, true);
            setcookie("meetingroom", $meetingroom, 0, "/", "", false, true);
            setcookie("item", $item_str, 0, "/", "", false, true);
            setcookie("BorrowDay", $BorrowDay, 0, "/", "", false, true);
            setcookie("section_start", $start, 0, "/", "", false, true);
            setcookie("section_end", $end, 0, "/", "", false, true);

            // 將資料匯進資料庫
            $sql = "INSERT INTO reserved_meetingroom (id, studentid, username, meetingroom, teacher, item, BorrowDay, start, end) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssss", $borrowId, $studentid, $username, $meetingroom, $teacher, $item_str, $BorrowDay, $start, $end);
            $stmt->execute();
            $stmt->close();

            // 轉址到index.php
            echo "<script>alert('預約成功');";
            echo "window.location.href='myreserve.php?data=StatusMeetingroom';</script>";
            exit();
        }
    }
}
else{
    // 轉址到login.php
    echo "<script>alert('尚未登入');";
    echo "window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
  
    <title>嘉大資工系教室管理與器材借用系統 | 借用研討室登記</title>
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
  
    <!-- PLUGINS CSS STYLE -->
    <link href="assets/css/simplebar/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
    
    <!-- No Extra plugin used -->
  <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />
  
    <!-- FAVICON -->
    <link href="assets/img/logo.png" rel="shortcut icon" />
  
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
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">

      
      




        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer" >
            <!-- Aplication Brand -->
            <div class="app-brand" style="background-color:#B0C4DE" >
              <a href="index.php" title="NCYU CSIE Dashboard" >
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
                <li class="has-sub ">
                  <!--<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
                    aria-expanded="false" aria-controls="components">
                    <i class="mdi mdi-folder-multiple-outline"></i>
                    <span class="nav-text">一般教室借用</span> <b class="caret"></b>
                  </a> -->

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

                <li class="has-sub active expand">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                    aria-expanded="false" aria-controls="app">
                    <i class="mdi mdi-pencil-box-multiple"></i>
                    <span class="nav-text">借用登記</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse show" id="app" data-parent="#sidebar-menu">
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
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
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
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#authentication"
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
                      <img src="assets/img/user.png" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block"><?php echo $username; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header" style="margin-bottom: 0;">
                        <img src="assets/img/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                          <?php echo $username; ?> <small class="pt-1"><?php echo $gmail; ?></small>
                        </div>
                      </li>

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






<!-- highlighted alerts -->
<div class="card card-default">

	<div class="card-body">
	    <center><h2 style="color:#4d5a80"><b>研討室借用</b></h2></center><hr><br>
		<div class="row">
			<div class="col-12">
				    <form action="meetingroom.php" method="POST" style="color:black;">
				        
        <!--研討室-->
        <label for="meetingroom"><b><font color="#394d84" size="4">借用研討室：</font></b></label><br>
        &nbsp;&nbsp;<input type="radio" value="519" name="meetingroom" id="519" />
        <label for="519">519</label>
        &nbsp;&nbsp;<input type="radio" value="520" name="meetingroom" id="520" />
        <label for="520">520</label>
        <div style="float: right;">
            <img src="computer.jpg" width="400" height="341"/>
        </div>
        &nbsp;&nbsp;<input type="radio" value="523" name="meetingroom" id="523" />
        <label for="523">523</label>
        &nbsp;&nbsp;<input type="radio" value="524" name="meetingroom" id="524" />
        <label for="524">524</label>
        <br>
        <!--指導教師-->
        <label for="teacher"><b><font color="#394d84" size="4">指導教師：</font></b></label><br>
        <input type="text" name="teacher"/>
        <br><br>
        <!--物品-->
        <label for="item"><b><font color="#394d84" size="4">借用物品：</font></b></label><br>
        &nbsp;&nbsp;<input type="checkbox" value="鑰匙" name="item[]" id="key" />
        <label for="key">鑰匙</label>
        &nbsp;&nbsp;<input type="checkbox" value="單槍" name="item[]" id="projector" />
        <label for="projector">單槍</label>
        <br><br>
        <!--日期-->
        <label for="BorrowDay"><b><font color="#394d84" size="4">借用日期：</font></b></label><br>
        <input type="date" id="BorrowDay" name="BorrowDay"><br>
        <br>
        
        <!--節數-->
        <label for="section"><b><font color="#394d84" size="4">借用節數：</font></b></label><br>
        <strong>從&nbsp;&nbsp;</strong> 第&nbsp;&nbsp;
        <select name="section_start">
            <option value="1">一</option>
            <option value="2">二</option>
            <option value="3">三</option> 
            <option value="4">四</option>
            <option value="5">五</option>
            <option value="6">六</option> 
            <option value="7">七</option>
            <option value="8">八</option>
            <option value="9">九</option>
            <option value="A">A</option> 
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option> 
         </select>
         節
         <strong>到</strong> 第
        <select name="section_end">
            <option value="1">一</option>
            <option value="2">二</option>
            <option value="3">三</option> 
            <option value="4">四</option>
            <option value="5">五</option>
            <option value="6">六</option> 
            <option value="7">七</option>
            <option value="8">八</option>
            <option value="9">九</option>
            <option value="A">A</option> 
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option> 
        </select>
        節
        <br><br><br>
        <center><input class="button-28" type="submit" value="送出"></center><br>
    </form>
			</div>
			

			</div>
		</div>
	</div>
</div>
      </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    
    
    <!-- Footer -->
    
    

    </div> <!-- End Page Wrapper -->


    <!-- <script type="module">
      import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

      const el = document.createElement('pwa-update');
      document.body.appendChild(el);
    </script> -->

    <!-- Javascript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/simplebar/simplebar.min.js"></script>
    <script src="assets/js/sleek.js"></script>
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
    
    
        <style>
            .button-28 {
                appearance: none;
                background-color: transparent;
                border: 2px solid #394d84;
                border-radius: 15px;
                box-sizing: border-box;
                color: #394d84;
                cursor: pointer;
                display: inline-block;
                font-family: Roobert,-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
                font-size: 16px;
                font-weight: 600;
                line-height: normal;
                margin: 0;
                min-height: 20px;
                min-width: 0;
                outline: none;
                padding: 6px 12px;
                text-align: center;
                text-decoration: none;
                transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
                user-select: none;
                -webkit-user-select: none;
                touch-action: manipulation;
                width: 15%;
                will-change: transform;
                }
    
                .button-28:disabled {
                     pointer-events: none;
                }
    
                .button-28:hover {
                    color: #fff;
                    background-color: #394d84;
                    box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
                    transform: translateY(-2px);
                }
    
                .button-28:active {
                    box-shadow: none;
                    transform: translateY(0);
                }
    
    
                .custom-select {
      position: relative;
      font-family: Arial;
    }
    
    .custom-select select {
      display: none; /*hide original SELECT element: */
    }
    
    .select-selected {
      background-color: #394d84;
    }
    
    /* Style the arrow inside the select element: */
    .select-selected:after {
      position: absolute;
      content: "";
      top: 14px;
      right: 10px;
      width: 0;
      height: 0;
      border: 6px solid transparent;
      border-color: #fff transparent transparent transparent;
    }
    
    /* Point the arrow upwards when the select box is open (active): */
    .select-selected.select-arrow-active:after {
      border-color: transparent transparent #fff transparent;
      top: 7px;
    }
    
    /* style the items (options), including the selected item: */
    .select-items div,.select-selected {
      color: #ffffff;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
    }
    
    /* Style items (options): */
    .select-items {
      position: absolute;
      background-color: DodgerBlue;
      top: 100%;
      left: 0;
      right: 0;
      z-index: 99;
    }
    
    /* Hide the items when the select box is closed: */
    .select-hide {
      display: none;
    }
    
    .select-items div:hover, .same-as-selected {
      background-color: rgba(0, 0, 0, 0.1);
    }
    
    .formbold-form-label {
        color: #394d84;
        font-weight: 500;
        font-size: 14px;
        line-height: 24px;
        display: block;
        margin-bottom: 10px;
      }
      
    
        </style>

    
</body>


    
</html>

