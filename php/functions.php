<?php
@session_start();

function get_publish_article()
{
    $datas = array();

    $sql = "SELECT * FROM`article`WHERE`publish` = 1"; //找出article內文章發布是1的文章把它撈出來

    $query = mysqli_query($_SESSION['link'], $sql);  //儲存執行結果

    if($query)  //如果請求成功
    {
        if(mysqli_num_rows($query) > 0)
        {
            while($row = mysqli_fetch_assoc($query)){
                $datas[] = $row;
            }
        }
    }
    else       //執行失敗
    {
        echo "{$sql}語法請求失敗 :<br/>" . mysqli_error($_SESSION['link']);
    }

    return $datas;
}

function get_all_article()
{
    $datas = array();

    $sql = "SELECT * FROM`article`"; //找出article內文章發布是1的文章把它撈出來

    $query = mysqli_query($_SESSION['link'], $sql);  //儲存執行結果

    if($query)  //如果請求成功
    {
        if(mysqli_num_rows($query) > 0)
        {
            while($row = mysqli_fetch_assoc($query)){
                $datas[] = $row;
            }
        }
    }
    else       //執行失敗
    {
        echo "{$sql}語法請求失敗 :<br/>" . mysqli_error($_SESSION['link']);
    }

    return $datas;
}


//取得發布文章
function get_article($id)
{
    $result = null;

    $sql = "SELECT * FROM`article`WHERE`publish` = 1 AND `id`= {$id}"; //找出article內文章發布是1的文章把它撈出來

    $query = mysqli_query($_SESSION['link'], $sql);  //儲存執行結果

    if ($query)  //如果請求成功
    {
        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_fetch_assoc($query);
        }
    } else       //執行失敗
    {
        echo "{$sql}語法請求失敗 :<br/>" . mysqli_error($_SESSION['link']);
    }
    return $result;
}


//取得編輯文章
function get_edit_article($id)
{
    $result = null;

    $sql = "SELECT * FROM`article` WHERE `id`= {$id}"; //找出article內文章發布是1的文章把它撈出來

    $query = mysqli_query($_SESSION['link'], $sql);  //儲存執行結果

    if ($query)  //如果請求成功
    {
        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_fetch_assoc($query);
        }
    } else       //執行失敗
    {
        echo "{$sql}語法請求失敗 :<br/>" . mysqli_error($_SESSION['link']);
    }
    return $result;
}


//新增文章
function add_article($title, $content, $publish)
{
    //宣告要回傳的結果
    $result = null;

    $create_date = date("Y-m-d H:i:s");

    //$creater_id = $_SESSION['login_user_id'];

    //將查詢語法當成字串，記錄在$sql變數中
    $sql = "INSERT INTO `article` (`title`, `content`, `publish`, `create_date`) 
            VALUE ('{$title}', '{$content}', {$publish}, '{$create_date}')";

    //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
    $query = mysqli_query($_SESSION['link'], $sql);

    //如果請求成功
    if ($query)
    {
        //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
        if(mysqli_affected_rows($_SESSION['link']) == 1)
        {
            //取得的量大於0代表有資料
            //回傳的 $result 就給 true 代表有該帳號，不可以被新增
            $result = true;
        }
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    //回傳結果
    return $result;
}


//更新文章
function update_article($id, $title, $content, $publish)
{
    //宣告要回傳的結果
    $result = null;

    $modify_date = date("Y-m-d H:i:s");

    //將查詢語法當成字串，記錄在$sql變數中
    $sql = "UPDATE `article` 
            SET`title`='{$title}',
            `content`='$content',
            `publish`=$publish,
            `modify_date`='{$modify_date}'
            WHERE `id` = $id";

    //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
    $query = mysqli_query($_SESSION['link'], $sql);

    //如果請求成功
    if ($query)
    {
        //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
        if(mysqli_affected_rows($_SESSION['link']) == 1)
        {
            //取得的量大於0代表有資料
            //回傳的 $result 就給 true 代表有該帳號，不可以被新增
            $result = true;
        }
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    //回傳結果
    return $result;
}



//刪除文章
function del_article($id)
{
    //宣告要回傳的結果
    $result = null;

    //將查詢語法當成字串，記錄在$sql變數中
    $sql = "DELETE FROM `article`
            WHERE `id` = $id";

    //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
    $query = mysqli_query($_SESSION['link'], $sql);

    //如果請求成功
    if ($query)
    {
        //使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
        if(mysqli_affected_rows($_SESSION['link']) == 1)
        {
            //取得的量大於0代表有資料
            //回傳的 $result 就給 true 代表有該帳號，不可以被新增
            $result = true;
        }
    }
    else
    {
        echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
    }

    //回傳結果
    return $result;
}
?>