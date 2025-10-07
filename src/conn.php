<?php
$server = 'db';
$dbusername = 'user';
$dbpassword = 'pass';
$dbname = 'LAMP';

$conn = new mysqli($server, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>