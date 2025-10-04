<?php
//載入資料庫與處理的方法
require_once 'db.php';
require_once 'functions.php';

$check = add_article($_POST['title'], $_POST['content'], $_POST['publish']);

if($check)
{
    //若為true 代表新增成功，印出yes
    echo 'yes';
}
else
{
    //若為 null 或者 false 代表失敗
    echo 'no';
}

?>
