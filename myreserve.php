<?php
    session_start();
    require "conn.php";

    $studentid = $_SESSION['studentid'];
    $username = $_SESSION['username'];
    
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '訪客';
    $gmail = isset($_SESSION['gmail']) ? $_SESSION['gmail'] : '請先登入';
    
    if(!$username){
        echo "<script>alert('請先登入');";
        echo "window.location.href='index.php';</script>";
        exit();
    }
    // $selectSql = "SELECT studentid, username, gmail, mail, phonenum, role FROM students";
    // $selectStmt = $conn->prepare($selectSql);
    // $selectStmt->execute();
    // $selectStmt->bind_result($studentid, $username, $gmail, $mail, $phonenum, $role);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
  
    <title>嘉大資工系教室管理與器材借用系統 | 我的預約</title>
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
  
    <!-- PLUGINS CSS STYLE -->
    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  
    <!-- No Extra plugin used -->
    
    <link href='assets/plugins/daterangepicker/daterangepicker.css' rel='stylesheet'>
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
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand" style="background-color:#B0C4DE" >
              <a href="index.php" title="NCYU CSIE Dashboard">
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
                
                
                <li class="has-sub active expand">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="nav-text">借用紀錄</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse show" id="dashboard" data-parent="#sidebar-menu">
                    <div class="sub-menu">

                      <li class="">
                        <a class="sidenav-item-link" href="myreserve.php?data=StatusClassroom" >
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
                   
                
                
                <div class="card card-default">
                	<div class="card-header card-header-border-bottom">
                	   
            		<h2>
            		    <?php
                		if(isset($_GET['data']) && $_GET['data'] === 'UserData'){
                		    echo "個人資料";
                		}
                		elseif(isset($_GET['data']) && $_GET['data'] === 'StatusClassroom'){
                		    echo '<h2 style="color:#4d5a80; font-size: 35px;"><b>一般教室借用紀錄</b></h2>';

                		}
                		elseif(isset($_GET['data']) && $_GET['data'] === 'StatusMeetingroom'){
                		    echo '<h2 style="color:#4d5a80; font-size: 35px;"><b>研討室借用紀錄</b></h2>';
                		}
                		elseif(isset($_GET['data']) && $_GET['data'] === 'StatusItem'){
                		    echo '<h2 style="color:#4d5a80; font-size: 35px;"><b>設備借用紀錄</b></h2>';
                		}
                		?>
            		</h2>
            	</div>
            	<div class="card-body">
            	    <div class="row">
            	    
                		<?php
                		//使用者自己的個人資料
                		if(isset($_GET['data']) && $_GET['data'] === 'UserData'){
                		    echo'
                		    <img src="assets/img/user.png" alt="user image" width="350px" >
                		    <div class="contact-info pt-4">
                		    <div class="profile-content-left profile-left-spacing pt-5 pb-3 px-3 px-xl-5">
                		    <h4 class="py-2 text-dark">'. $_SESSION['username'] .'</h4>
                            <p><?php echo'. $_SESSION['gmail'] .'</p>
                              <p class="text-dark font-weight-medium pt-4 mb-2">學號</p>
                              <p> '. $_SESSION["studentid"] .'</p>
                              <p class="text-dark font-weight-medium pt-4 mb-2">私人信箱</p>
                              <p>' . $_SESSION["mail"] . '</p>
                              <p class="text-dark font-weight-medium pt-4 mb-2">電話號碼</p>
                              <p>' . $_SESSION["phonenum"] .'</p>
                              <br>
                            </div>
                		    ';
                		}
                		
                		//使用者借用狀況-一般教室
                        if(isset($_GET['data']) && $_GET['data'] === 'StatusClassroom'){
                            // 獲取預約的筆數
                            $countSql = "SELECT COUNT(*) FROM reserved_classroom WHERE studentid = ? AND username = ?";
                            $countStmt = $conn->prepare($countSql);
                            $countStmt->bind_param("ss", $studentid, $username);
                            $countStmt->execute();
                            $countStmt->bind_result($rowCount);
                            $countStmt->fetch();
                            $countStmt->close();
                            if ($rowCount > 0) {
                            $selectSql = "SELECT id, classroom, item, BorrowDay, start, end FROM reserved_classroom WHERE studentid = ? AND username = ? ORDER BY BorrowDay ASC";
                            $selectStmt = $conn->prepare($selectSql);
                            $selectStmt->bind_param("ss", $studentid, $username);
                            $selectStmt->execute();
                            $selectStmt->bind_result($id, $classroom, $item, $BorrowDay, $start, $end);
                        
                            echo "<table>";
                            echo "<tr>";
                            echo "<th hidden>編號</th><th>借用教室</th><th>借用物品</th><th>借用日期</th><th>借用時間</th><th colspan=4>功能</th>";
                            echo "</tr>";
                        
                            while ($selectStmt->fetch()) {
                                // $idParts = explode("-", $id);
                                // $numericId = end($idParts);
                                echo "<tr>";
                                echo "<td hidden>" . $id . "</td>";
                                echo "<td>" . $classroom . "</td>";
                                echo "<td>" . $item . "</td>";
                                echo "<td>" . $BorrowDay . "</td>";
                                echo "<td>從 第 $start 節 到 第 $end 節</td>";
                                echo '<td><a class="gray-button" href="delete.php?id=' . $id . '">取消借用</a></td>';
                                echo "</tr>";
                            }
                            echo "</table>";
                            } else {
                                echo "<br>目前沒有借用教室的記錄<br>";
                            }
                
                        }
                
                        //使用者借用狀況-研討室
                        if(isset($_GET['data']) && $_GET['data'] === 'StatusMeetingroom'){
                            // 獲取預約的筆數
                            $countSql = "SELECT COUNT(*) FROM reserved_meetingroom WHERE studentid = ? AND username = ?";
                            $countStmt = $conn->prepare($countSql);
                            $countStmt->bind_param("ss", $studentid, $username);
                            $countStmt->execute();
                            $countStmt->bind_result($rowCount);
                            $countStmt->fetch();
                            $countStmt->close();
                            
                            // 如果有預約的數量大於 0，則執行查詢
                            if ($rowCount > 0) {
                                $selectSql = "SELECT id, meetingroom, teacher, item, BorrowDay, start, end FROM reserved_meetingroom WHERE studentid = ? AND username = ? ORDER BY BorrowDay ASC";
                                $selectStmt = $conn->prepare($selectSql);
                                $selectStmt->bind_param("ss", $studentid, $username);
                                $selectStmt->execute();
                                $selectStmt->bind_result($id, $meetingroom, $teacher, $item, $BorrowDay, $start, $end);
                            
                                echo "<table>";
                                echo "<tr>";
                                echo "<th hidden>編號</th><th>借用研討室</th><th>指導教師</th><th>借用物品</th><th>借用日期</th><th>借用時間</th><th colspan=4>功能</th>";
                                echo "</tr>";
                            
                                while ($selectStmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td hidden>" . $id . "</td>";
                                    echo "<td>" . $meetingroom . "</td>";
                                    echo "<td>" . $teacher . "</td>";
                                    echo "<td>" . $item . "</td>";
                                    echo "<td>" . $BorrowDay . "</td>";
                                    echo "<td>從 第 $start 節 到 第 $end 節</td>";
                                    echo '<td><a class="gray-button" href="delete.php?id=' . $id . '">取消借用</a></td>';
                                    echo "</tr>";
                                }
                                echo "</table>";
                            
                                $selectStmt->free_result();
                                $selectStmt->close();
                                // $conn->close();
                            } else {
                                echo "目前沒有借用研討室的記錄。";
                            }
                        }
                
                        // 使用者借用狀況-設備
                        if(isset($_GET['data']) && $_GET['data'] === 'StatusItem'){
                            // 獲取預約的筆數
                            $countSql = "SELECT COUNT(*) FROM reserved_item WHERE studentid = ? AND username = ?";
                            $countStmt = $conn->prepare($countSql);
                            $countStmt->bind_param("ss", $studentid, $username);
                            $countStmt->execute();
                            $countStmt->bind_result($rowCount);
                            $countStmt->fetch();
                            $countStmt->close();
                            
                            // 如果有預約的數量大於 0，則執行查詢
                            if ($rowCount > 0) {
                                $selectSql = "SELECT id, studentid, username, brand, item, BorrowDay, BorrowTime FROM reserved_item WHERE studentid = ? AND username = ? ORDER BY BorrowDay ASC";
                                $selectStmt = $conn->prepare($selectSql);
                                $selectStmt->bind_param("ss", $studentid, $username);
                                $selectStmt->execute();
                                $selectStmt->bind_result($id, $studentid, $username, $brand, $item_str, $BorrowDay, $BorrowTime);
                            
                                echo "<table>";
                                echo "<tr>";
                                echo "<th hidden>編號</th><th>廠牌</th><th>借用物品</th><th>借用日期</th><th>借用時間</th><th colspan=4>功能</th>";
                                echo "</tr>";
                            
                                while ($selectStmt->fetch()) {
                                    echo "<tr>";
                                    echo "<td hidden>" . $id . "</td>";
                                    echo "<td>" . $brand . "</td>";
                                    echo "<td>" . $item_str . "</td>";
                                    echo "<td>" . $BorrowDay . "</td>";
                                    echo "<td>" . $BorrowTime . "</td>";
                                    echo '<td><a class="gray-button" href="delete.php?id=' . $id . '">取消借用</a></td>';
                                    echo "</tr>";
                                }
                                echo "</table>";
                            
                                $selectStmt->free_result();
                                $selectStmt->close();
                                $conn->close();
                            } else {
                                echo "<br>目前沒有借用設備的記錄。<br>";
                            }
                        }
                    ?>
    		
    			
    		</div>
    	</div>
    </div>
    <style>
        /* 基本表格樣式 */
        table {
            margin-left:100px;
            border-collapse: collapse;
            width: 80%;
              border-collapse: collapse;
            text-align: center;
             margin-top:30px;
            margin-bottom:30px;
    
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
  <script src='assets/plugins/daterangepicker/moment.min.js'></script>
    <script src='assets/plugins/daterangepicker/daterangepicker.js'></script>
    <script src='assets/js/date-range.js'></script>
<!--<script src="assets/js/sleek.js"></script>-->
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
</body>
</html>