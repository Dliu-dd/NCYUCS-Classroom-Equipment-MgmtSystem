<?php
session_start();
require "conn.php";

if (isset($_GET['id'])) {
    $studentid = $_SESSION['studentid'];
    $username = $_SESSION['username'];
    $id = $_GET['id'];

    $deleteMeetingroomSql = "DELETE FROM reserved_meetingroom WHERE id = ?";
    $deleteMeetingroomStmt = $conn->prepare($deleteMeetingroomSql);
    $deleteMeetingroomStmt->bind_param("s", $id);
    $deleteMeetingroomStmt->execute();
    $deleteMeetingroomStmt->close();

    $deleteClassroomSql = "DELETE FROM reserved_classroom WHERE id = ?";
    $deleteClassroomStmt = $conn->prepare($deleteClassroomSql);
    $deleteClassroomStmt->bind_param("s", $id);
    $deleteClassroomStmt->execute();
    $deleteClassroomStmt->close();

    $deleteItemSql = "DELETE FROM reserved_item WHERE id = ?";
    $deleteItemStmt = $conn->prepare($deleteItemSql);
    $deleteItemStmt->bind_param("s", $id);
    $deleteItemStmt->execute();
    $deleteItemStmt->close();

    if($username === '管理員' && $studentid === '04Dm!N'){
        if(strpos($_SERVER['REQUEST_URI'],'i')){
        echo "<script>alert('歸還成功');";
        echo "window.location.href='admin.php?data=StatusItem';</script>";
        }
        if(strpos($_SERVER['REQUEST_URI'],'c')){
        echo "<script>alert('歸還成功');";
        echo "window.location.href='admin.php?data=StatusClassroom';</script>";
        }
        if(strpos($_SERVER['REQUEST_URI'],'m')){
        echo "<script>alert('歸還成功');";
        echo "window.location.href='admin.php?data=StatusMeetingroom';</script>";
        }
    }
    else{
        if(strpos($_SERVER['REQUEST_URI'],'i')){
        echo "<script>alert('已取消借用');";
        echo "window.location.href='myreserve.php?data=StatusItem';</script>";
        }
        if(strpos($_SERVER['REQUEST_URI'],'c')){
        echo "<script>alert('已取消借用');";
        echo "window.location.href='myreserve.php?data=StatusClassroom';</script>";
        }
        if(strpos($_SERVER['REQUEST_URI'],'m')){
        echo "<script>alert('已取消借用');";
        echo "window.location.href='myreserve.php?data=StatusMeetingroom';</script>";
        }
    }
    

    $conn->close();
}
?>