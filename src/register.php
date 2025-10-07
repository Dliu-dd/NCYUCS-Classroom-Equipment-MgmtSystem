<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require "conn.php";
    
    $role = $_POST["role"];
    $username = $_POST["username"];
    $studentid = $_POST["studentid"];
    $phonenum = $_POST["phonenum"];
    $mail = $_POST["mail"];
    $password = hash('sha512', $_POST['password']);
    if($studentid === ''){
        $gmail = $mail;
    }
    else{
        $gmail =  "s".$_POST["studentid"]."@g.ncyu.edu.tw";
    }

    if($role === 'student' && $studentid === ''){
        echo "<script>alert('你選擇嘉大學生的身分，請輸入學號！');";
        echo "window.location.href='register.php';</script>";
    }
    
    $check_query = "SELECT * FROM students WHERE studentid = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $studentid);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($role === 'student' && $check_stmt->num_rows > 0) {
        $check_stmt->close();
        $conn->close();
        echo "<script>alert('帳號已被註冊！');";
        echo "window.location.href='login.php';</script>";
        exit();
    }

    $check_stmt->close();

    $sql = "INSERT INTO students (role, username, studentid, phonenum, mail, password, gmail) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $role, $username, $studentid, $phonenum, $mail, $password, $gmail);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<script>alert('成功註冊！');";
    echo "window.location.href='login.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">

    <title>嘉大資工系教室管理與器材借用系統 | 註冊</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

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

  <body class="" id="body">
    <div class="container d-flex align-items-center justify-content-center">
      <div class="row justify-content-center" style='margin-top:20px; margin-bottom:20px;'>
        <div class="col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header" style = "background-color:#B0C4DE;">
              <div class="app-brand" style = "background-color:#B0C4DE;" >
                <!--<a href="/index.html">-->
                  <!--<svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"-->
                  <!--  height="33" viewBox="0 0 30 33">-->
                    <img src='assets/img/newlogo.png' alt='logo' width='55px'/>
                  <!--</svg>-->
                    <span class="brand-name" style='font-size:23px'>嘉義大學資工系教室管理與借用系統</span>
                 
                <!--</a>-->
              </div>
              <!--<span class="brand-name">嘉義大學資工系教室管理與借用系統</span>-->
            </div>

            <div class="card-body p-5">
              <h2 class="text-dark mb-5">註冊</h2>

              <form method="POST" action="register.php" name="register" onsubmit="return validatePassword();">
                <div class="row">
                    <div class="form-group col-md-12 mb-4">
                    <input type="radio" id="student" name="role"  value="student"/><label for="student">嘉義大學學生</label>
                    <input type="radio" id="teacher" name="role" value="teacher"/><label for="teacher">嘉義大學老師</label>
                    <input type="radio" id="others" name="role" value="others"/><label for="others">校外人士</label>
                  </div>
                  <div class="form-group col-md-12 mb-4">
                    <!--<input type="text" class="form-control input-lg" id="name" aria-describedby="nameHelp" placeholder="Name">-->
                    <label for="username" class="form-label">姓名</label>
                    <input class="form-control input-lg" type="text" id="username" name="username" placeholder="請輸入姓名" required>
                  </div>

                  <div class="form-group col-md-12 mb-4">
                    <!--<input type="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" placeholder="Username">-->
                    <label for="studentid" class="form-label">學號</label>
                    <input class="form-control input-lg" type="text" id="studentid" name="studentid" placeholder="請輸入學號" pattern="\d+">
                  </div>

                  <div class="form-group col-md-12 ">
                      <label for="phonenum" class="form-label">電話號碼</label>
                        <input class="form-control input-lg" type="text" id="phonenum" name="phonenum" placeholder="09xx-xxx-xxx" pattern="09\d{2}-?\d{3}-?\d{3}" required>
                    <!--<input type="password" class="form-control input-lg" id="password" placeholder="Password">-->
                  </div>
                  
                  <div class="form-group col-md-12 ">
                        <label for="mail" class="form-label">信箱</label>
                        <input class="form-control input-lg" type="email" id="mail" name="mail" placeholder="example@mail.com" required>
                  </div>

                  <div class="form-group col-md-12 ">
                    <label for="password1" class="form-label input-lg">設定密碼</label>
            <input class="form-control" type="password" id="password1" name="password" placeholder="請輸入密碼" required>
                  </div>
                  
                  <div class="form-group col-md-12 ">
                    <label for="password2" class="form-label">確認密碼</label>
                    <input class="form-control input-lg" type="password" id="password2" name="password" placeholder="請輸入確認密碼" required>
                  </div>

                  <div class="col-md-12">
                    <div class="d-inline-block mr-3">
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
                    <input class="btn btn-lg btn-primary btn-block mb-4" type="submit" id="submit" name="register" value="送出">
                    <input class="btn btn-lg btn-primary btn-block mb-4" type="reset" id="reset" name="reset" value="重設">

                    <p>已經有帳號了?
                      <a class="text-blue" href="./login.php">登入</a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- <script type="module">
      import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';

      const el = document.createElement('pwa-update');
      document.body.appendChild(el);
    </script> -->

    <!-- Javascript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sleek.js"></script>
    <script>
        function validatePassword(){
            var password1 = document.getElementById("password1").value;
            var password2 = document.getElementById("password2").value;
            if(password1 != password2){
                alert("兩次輸入的密碼不一致，請重新輸入");
                window.location.reload();
                return false;
            }
            return true;
        }
    </script>
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
</body>
</html>
