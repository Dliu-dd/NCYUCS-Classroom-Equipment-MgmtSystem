<?php
$server = 'localhost';
$dbusername = 'id21678063_root';
$dbpassword = 'Php12251225!';
$dbname = 'id21678063_ncyucsie_db';

$conn = new mysqli($server, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>