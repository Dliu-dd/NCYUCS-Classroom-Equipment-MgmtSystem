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

//$datas = get_all_article();
//print_r($datas);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
  
    <!-- theme meta -->
    <meta name="theme-name" content="sleek" />
    
    <title>嘉大資工系教室管理與器材借用系統 | 管理者頁面</title>
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
  
    <!-- PLUGINS CSS STYLE -->
    <link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  
    <!-- No Extra plugin used -->
    <link href='assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css' rel='stylesheet'>
    <link href='assets/plugins/daterangepicker/daterangepicker.css' rel='stylesheet'>
    
    
    <link href='assets/plugins/toastr/toastr.min.css' rel='stylesheet'>
    
    
    
    
    
    

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
            <div class="app-brand" style="background-color:#B0C4DE" >
              <a  title="NCYU CSIE Dashboard">
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
                <span class="brand-name text-truncate" style='color:#2a394a;'>NCYU CSIE</span>
              </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                
                <li class="has-sub">
                  <a class="sidenav-item-link" href="admin.php?data=article">
                    <i class="mdi mdi-pencil-box-multiple"></i>
                    <span class="nav-text">最新公告</span>
                  </a></li>
                  
                <li class="has-sub">
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
                
                <li class="has-sub active expand">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
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

                  <ul class="collapse " id="forms" data-parent="#sidebar-menu">
                    
                  </ul>
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

                      <!--<li>
                        <a href="myreserve.php">
                          <i class="mdi mdi-account"></i> 我的預約
                        </a>
                      </li>-->
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


<div class="main">
    <div class="container">
        <br>
        <div class="row justify-content-center"> <!-- 將原本的 col-xs-12 修改為 col-12 -->
            <div class="col-12">
                <form id="article">
                    <div class="form-group">
                        <label for="title"><b><font color="#394d84" size="4">標題</font></b></label>
                        <input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="輸入標題">
                    </div>
                    <div class="form-group">
                        <label for="content"><b><font color="#394d84" size="4">內文</font></b></label>
                        <textarea id="content" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="publish" value="1" checked>
                            <label class="form-check-label" for="inlineRadio1">發布</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="publish" value="0">
                            <label class="form-check-label" for="inlineRadio2">不發布</label>
                            <div>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary" style="background-color:#B0C4DE;border:#B0C4DE;">存檔</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>




<div class="card card-default">
	
		<h2>
		<?php
		if(isset($_GET['data']) && $_GET['data'] === 'article'){
		    echo "";
		}
		if(isset($_GET['data']) && $_GET['data'] === 'UserData'){
		    echo "使用者資料";
		}
		elseif(isset($_GET['data']) && $_GET['data'] === 'StatusClassroom'){
		    echo "一般教室借用紀錄";   
		}
		elseif(isset($_GET['data']) && $_GET['data'] === 'StatusMeetingroom'){
		    echo "研討室借用紀錄";
		}
		elseif(isset($_GET['data']) && $_GET['data'] === 'StatusItem'){
		    echo "設備借用紀錄";
		}
		?>
		</h2>

		
			<?php
    
    // 管理員才可以看
    if($studentid === '04Dm!N' && $username === '管理員'){
        //最新公告
        if(isset($_GET['data']) && $_GET['data'] === 'article'){
            echo '<a href="article_add.php" class="btn btn-primary">新增公告</a>';
        }
        //使用者資料
        if(isset($_GET['data']) && $_GET['data'] === 'UserData'){
            echo "<table>
            <tr>
                <th>學號</th>
                <th>名字</th>
                <th>學校信箱</th>
                <th>私人信箱</th>
                <th>電話</th>
                <th>類型</th>
            </tr>";
            // 使用 prepared statement 查詢資料
            $selectSql = "SELECT studentid, username, gmail, mail, phonenum, role FROM students";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->execute();
            $selectStmt->bind_result($studentid, $username, $gmail, $mail, $phonenum, $role);
    
            // 顯示資料
            while ($selectStmt->fetch()) {
                echo "<tr>";
                echo "<td>$studentid</td>";
                echo "<td>$username</td>";
                echo "<td>$gmail</td>";
                echo "<td>$mail</td>";
                echo "<td>$phonenum</td>";
                echo "<td>$role</td>";
                echo "</tr>";
            }
    
            $selectStmt->close();
            echo "</table>";
        }
        //使用者借用狀況-一般教室
        if(isset($_GET['data']) && $_GET['data'] === 'StatusClassroom'){
            echo "<table>
                <tr>
                    <th>學號</th>
                    <th>名字</th>
                    <th>借用教室</th>
                    <th>借用物品</th>
                    <th>借用日期</th>
                    <th>借用時間</th>
                    <th>已歸還</th>
                </tr>";
        
            // 使用 prepared statement 查詢資料
            $selectSql = "SELECT id, studentid, username, classroom, item, BorrowDay, start, end FROM reserved_classroom ORDER BY BorrowDay ASC";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->execute();
            $selectStmt->bind_result($id, $studentid, $username, $classroom, $item, $BorrowDay, $start, $end);
        
            // 顯示資料
            while ($selectStmt->fetch()) {
                echo "<tr>";
                echo "<td>$studentid</td>";
                echo "<td>$username</td>";
                echo "<td>$classroom</td>";
                echo "<td>$item</td>";
                echo "<td>$BorrowDay</td>";
                echo "<td>從 第 $start 節 到 第 $end 節</td>";
                echo "<td><a href='delete.php?id=".$id."'>已歸還</a></td>";
                echo "</tr>";
            }
        
            $selectStmt->close();
        
            echo "</table>";
        
        }

        //使用者借用狀況-研討室
        if(isset($_GET['data']) && $_GET['data'] === 'StatusMeetingroom'){
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
                    <th>已歸還</th>
                </tr>";
    
            // 使用 prepared statement 查詢資料
            $selectSql = "SELECT id, studentid, username, meetingroom, teacher, item, BorrowDay, start, end FROM reserved_meetingroom ORDER BY BorrowDay ASC";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->execute();
            $selectStmt->bind_result($id, $studentid, $username, $meetingroom, $teacher, $item, $BorrowDay, $start, $end);
    
            // 顯示資料
            while ($selectStmt->fetch()) {
                echo "<tr>";
                echo "<td>$studentid</td>";
                echo "<td>$username</td>";
                echo "<td>$meetingroom</td>";
                echo "<td>$teacher</td>";
                echo "<td>$item</td>";
                echo "<td>$BorrowDay</td>";
                echo "<td>從 第 $start 節 到 第 $end 節</td>";
                echo "<td><a href='delete.php?id=".$id."'>已歸還</a></td>";
                echo "</tr>";
            }
    
            $selectStmt->close();
            echo "</table>";
        }

        // 使用者借用狀況-設備
        if(isset($_GET['data']) && $_GET['data'] === 'StatusItem'){
            echo "
            <table>
                <tr>
                    <th>學號</th>
                    <th>名字</th>
                    <th>借用廠牌</th>
                    <th>借用物品</th>
                    <th>借用日期</th>
                    <th>借用時間</th>
                    <th>已歸還</th>
                </tr>";
            // 使用 prepared statement 查詢資料
            $selectSql = "SELECT id, studentid, username, brand, item, BorrowDay, BorrowTime FROM reserved_item ORDER BY BorrowDay,BorrowTime ASC";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->execute();
            $selectStmt->bind_result($id, $studentid, $username, $brand, $item, $BorrowDay, $BorrowTime);
        
            // 顯示資料
            while ($selectStmt->fetch()) {
                echo "<tr>";
                echo "<td>$studentid</td>";
                echo "<td>$username</td>";
                echo "<td>$brand</td>";
                echo "<td>$item</td>";
                echo "<td>$BorrowDay</td>";
                echo "<td>$BorrowTime</td>";
                echo "<td><a href='delete.php?id=".$id."'>已歸還</a></td>";
                echo "</tr>";
            }
        
            $selectStmt->close();
            echo "</table>";
            }
    }
    else{
        echo '<script>alert("你不是管理員 >:(");';
        echo "window.location.href='login.php';</script>";
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
        
        
    </style>


		
                  <!-- Top Statistics -->



      </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
    
    
    <!-- Footer -->
    <footer class="footer mt-auto">
      <div class="copyright bg-white">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
    $(document).on("ready", function(){
        //表單送出
        $("#article").on("submit", function(){
            if($("#title").val() == '' || $("#content").val() == ''){
                alert("請填入標題或內文");
            }else{
                //使用 ajax 送出 帳密給 verify_user.php
                $.ajax({
                    type : "POST",
                    url : "./php/add_article.php", //因為此檔案是放在 admin 資料夾內，若要前往 php，就要回上一層 ../ 找到 php 才能進入 add_article.php
                    data : {
                        'title' : $("#title").val(), //標題
                        'content' : $("#content").val(), //內文˙
                        'publish': $("input[name='publish']:checked").val()
                    },
                    dataType : 'html' //設定該網頁回應的會是 html 格式
                }).done(function(data) {
                    //成功的時候
                    if(data === 'yes')
                    {
                        alert("新增成功，點擊確認回列表");
                        window.location.href = "admin.php?data=article";
                    }
                    else
                    {
                        alert("新增失敗" + data);
                    }

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
            }
            return false;
        });
    });
</script>
</body>
</html>

