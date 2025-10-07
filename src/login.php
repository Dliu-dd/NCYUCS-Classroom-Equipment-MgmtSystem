<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require "conn.php";

    $role = $_POST["role"];
    $gmail = $_POST["gmail"];
    
    if ($role === "student" && !strpos($gmail, '@g.ncyu.edu.tw')) {
        echo "<script>alert('學生帳號必須使用 @g.ncyu.edu.tw 登入');";
        echo "window.location.href='login.php';</script>";
        exit();
    }
    
    $password = hash('sha512', $_POST['password']);

    $field = ($role === "student") ? "gmail" : "mail";
    
    // 這邊使用參數化的SQL查詢，防止SQL Injection
    $stmt = $conn->prepare("SELECT username, studentid,gmail,phonenum,mail,role,password FROM students WHERE $field = ?");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->bind_result($username, $studentid, $gmail, $phonenum, $mail, $role, $stored_pwd_hashed);
    $stmt->fetch();
    $stmt->close();

    
    if ($stored_pwd_hashed !== null && $password===$stored_pwd_hashed) {

        $_SESSION["username"] = $username;
        $_SESSION["studentid"] = $studentid;
        $_SESSION["gmail"] = $gmail;
        $_SESSION["phonenum"] = $phonenum;
        $_SESSION["mail"] = $mail;
        $_SESSION["role"] = $role;

        
        setcookie("username", $username, 0, "/", "", false, true);
        setcookie("studentid", $studentid, 0, "/", "", false, true);

       
        if($role === "admin"){
            header("Location: admin.php?data=article");
        }
        else{
            header("Location: index.php");
        }
        exit();
    } else {
        echo "<script>alert('帳號密碼有錯誤 > <');";
        echo "window.location.href='login.php';</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">

    <title>嘉大資工系教室管理與器材借用系統 | 登入</title>

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
    <div class="container d-flex align-items-center justify-content-center vh-100" >
      <div class="row justify-content-center" >
        <div class="col-lg-6 col-md-10" >
          <div class="card" >
            <div class="card-header" style = "background-color:#B0C4DE;">
              <div class="app-brand" style = "background-color:#B0C4DE;" >
                <!--<a href="/index.php">-->
                    <!--<svg class="brand-icon" href="assets/img/logo.png" preserveAspectRatio="xMidYMid" width="30" height="33"-->
                    <!--viewBox="0 0 30 33">-->
                  <!--  <g fill="none" fill-rule="evenodd">-->
                      <!--<path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />-->
                  <!--    <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />-->
                  <!--  </g>-->
                  <!--</svg>-->
                    <img src='assets/img/newlogo.png' alt='logo' width='55px'>
                  <!--</svg>-->
                    <span class="brand-name" style='font-size:23px ;background-color:#B0C4DE;'>嘉義大學資工系教室管理與借用系統</span>
                </a>
              </div>
            </div>

            <div class="card-body p-5" > 
              <h2 class="text-dark mb-5">登入</h2>
              
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
              
              <form action="login.php" method="POST">
                  <div class="form-group col-md-12 mb-4"  >
                <!--使用者角色-->
                <input type="radio" id="student" name="role"  value="student"/><label for="student">嘉義大學學生</label>
                <input type="radio" id="teacher" name="role" value="teacher"/><label for="teacher">嘉義大學老師</label>
                <input type="radio" id="others" name="role" value="others"/><label for="others">校外人士</label>
                <input type="radio" id="admin" name="role" value="admin"/><label for="admin">管理員</label>
            </div>
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                  <input type="email" class="form-control input-lg" id="gmail" aria-describedby="emailHelp" name="gmail" value="s學號@g.ncyu.edu.tw" required/>
                  </div>

                  <div class="form-group col-md-12 " >
                  <input type="password" class="form-control input-lg" id="password" name="password"  placeholder="密碼" required/>
                  </div>

                  <div class="col-md-12">
                    <div class="d-flex my-2 justify-content-between" >
                      <div class="d-inline-block mr-3" >
                        <label class="control control-checkbox">記住密碼
                          <input type="checkbox" />
                          <div class="control-indicator" ></div>
                        </label>
                      </div>
                    </div>
                    <!--不確定-->
                    <input type="submit" class="btn btn-lg btn-primary btn-block mb-4" value="登入">

                    <p>沒有帳號嗎?
                      <a class="text-blue" href="register.php">註冊</a>
                      <br><br>
                      溫馨注意：如果你是嘉義大學學生，帳號請用<code>s學號@g.ncyu.edu.tw</code>進行登入
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
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>
</body>
</html>