<?php
session_start();
session_destroy();
setcookie("username", "", time()-3600, "/", "", false, true);
setcookie("studentid", "", time()-3600,  "/", "", false, true);
header("Location: login.php");
exit();
?>